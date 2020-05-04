<?php


namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StatisticRepository
{
    //TODO: need laravel queries for pagination
    public static function getAll($request)
    {
        $order = 'ID';

        if ($request->sort) {
            $order = $request->sort;
        }

        $res = DB::select(
            "SELECT T1.ID, T1.PROJ_REG, T1.PROJECT_TITLE, T1.COUNT_TASKS, T2.COUNT_EMPLOYEE, T1.MANAGER_FAM, T1.MANAGER_NAME, T1.MANAGER_PATRO, T3.RATE_TIME, T3.DIF_HOURS, T3.END_TASK
                FROM
                (SELECT  PR.ID ID, PR.REG_NUM PROJ_REG, PR.TITLE PROJECT_TITLE, PR.MANAGER_ID, EM.LAST_NAME MANAGER_FAM, EM.FIRST_NAME MANAGER_NAME, EM.SECOND_NAME MANAGER_PATRO, COUNT(TS.PROJECT_ID) COUNT_TASKS
                FROM projects PR
                LEFT JOIN tasks TS ON PR.ID = TS.PROJECT_ID
                LEFT JOIN employees EM ON PR.MANAGER_ID = EM.ID
                GROUP BY PR.ID) T1
                INNER JOIN
                (SELECT  PR.ID ID, PR.REG_NUM, PR.TITLE, COUNT(DISTINCT ET.EMPLOYEE_ID) COUNT_EMPLOYEE
                FROM projects PR
                LEFT JOIN tasks TS ON PR.ID = TS.PROJECT_ID
                LEFT JOIN employees_tasks ET ON TS.ID = ET.TASK_ID
                group by ID
                ) T2
                ON T1.ID = T2.ID
                LEFT JOIN
                (SELECT PR.ID ID, PR.TITLE, SUM(DATEDIFF(TS.FINISH_DATE,TS.START_DATE)*8) DIF_HOURS, COUNT(TS.STATUS) END_TASK, SUM(RATE_TIME) RATE_TIME FROM projects PR
				INNER JOIN tasks TS ON PR.ID = TS.PROJECT_ID
				WHERE TS.STATUS = 3
				GROUP BY PR.ID
				) T3
                ON T1.ID = T3.ID  ORDER BY " . $order
        );

        return $res;
    }

    private function getDataForCsv()
    {
        $res = DB::select(
            "SELECT T1.ID, T1.PROJ_REG, T1.PROJECT_TITLE, T1.COUNT_TASKS, T2.COUNT_EMPLOYEE, T1.MANAGER_FAM, T1.MANAGER_NAME, T1.MANAGER_PATRO, T3.RATE_TIME, T3.DIF_HOURS, T3.END_TASK
                FROM
                (SELECT  PR.ID ID, PR.REG_NUM PROJ_REG, PR.TITLE PROJECT_TITLE, PR.MANAGER_ID, EM.LAST_NAME MANAGER_FAM, EM.FIRST_NAME MANAGER_NAME, EM.SECOND_NAME MANAGER_PATRO, COUNT(TS.PROJECT_ID) COUNT_TASKS
                FROM projects PR
                LEFT JOIN tasks TS ON PR.ID = TS.PROJECT_ID
                LEFT JOIN employees EM ON PR.MANAGER_ID = EM.ID
                GROUP BY PR.ID) T1
                INNER JOIN
                (SELECT  PR.ID ID, PR.REG_NUM, PR.TITLE, COUNT(DISTINCT ET.EMPLOYEE_ID) COUNT_EMPLOYEE
                FROM projects PR
                LEFT JOIN tasks TS ON PR.ID = TS.PROJECT_ID
                LEFT JOIN employees_tasks ET ON TS.ID = ET.TASK_ID
                group by ID
                ) T2
                ON T1.ID = T2.ID
                LEFT JOIN
                (SELECT PR.ID ID, PR.TITLE, SUM(DATEDIFF(TS.FINISH_DATE,TS.START_DATE)*8) DIF_HOURS, COUNT(TS.STATUS) END_TASK, SUM(RATE_TIME) RATE_TIME FROM projects PR
				INNER JOIN tasks TS ON PR.ID = TS.PROJECT_ID
				WHERE TS.STATUS = 3
				GROUP BY PR.ID
				) T3
                ON T1.ID = T3.ID  ORDER BY T1.ID"
        );

        $terminalResult = array();

        foreach ($res as $k => $re) {
            foreach ($re as $r) {
                $terminalResult[$k][] = $r;
            }
        }

        return $terminalResult;
    }

    /**
     * @param array $columnNames
     * @param array $rows
     * @param string $fileName
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    private function getCsv($columnNames, $rows, $fileName = 'file.csv')
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $fileName,
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
        $callback = function () use ($columnNames, $rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columnNames, ';');
            foreach ($rows as $row) {
                fputcsv($file, $row, ';');
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function csv()
    {
        $rows = $this->getDataForCsv();

        $columnNames = array(
            '#',
            'Обозначение',
            'Наименование',
            'Количество задач',
            'Количество сотрудников',
            'Фамилия',
            'Имя',
            'Отчество',
            'Планируемое количество часов',
            'Реальное количество часов',
            'Всего закрыто задач'
        );
        return $this->getCsv($columnNames, $rows);
    }


}
