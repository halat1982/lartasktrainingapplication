SET GLOBAL log_bin_trust_function_creators = 1;
DELIMITER //
CREATE FUNCTION test_task.DifHours(find DATETIME, std DATETIME, ratetime INT)
    RETURNS INT

BEGIN
    DECLARE h INT;
    DECLARE i INT;
    DECLARE rth INT;

    IF find IS NULL THEN
        RETURN NULL;
    end if;

    SET h = 0;
    SET i = 0;

    wloop:
    WHILE DATEDIFF(find, std) >= 0
        DO
            IF DAYOFWEEK(std) >= 6 THEN
                SET std = DATE_ADD(std, INTERVAL 1 DAY);
                ITERATE wloop;
            end if;
            SET h = h + 8;
            SET std = DATE_ADD(std, INTERVAL 1 DAY);
        end while wloop;

    SET rth = ratetime;
    SET i = h - rth;

    RETURN i;

END;
//

CREATE FUNCTION test_task.DifHoursBehindDates(find DATETIME, std DATETIME)
    RETURNS INT

BEGIN
    DECLARE h INT;

    IF find IS NULL THEN
        RETURN NULL;
    end if;

    SET h = 0;

    wloop:
    WHILE DATEDIFF(find, std) >= 0
        DO
            IF DAYOFWEEK(std) >= 6 THEN
                SET std = DATE_ADD(std, INTERVAL 1 DAY);
                ITERATE wloop;
            end if;
            SET h = h + 8;
            SET std = DATE_ADD(std, INTERVAL 1 DAY);
        end while wloop;

    RETURN h;

END;
//

DELIMITER ;


