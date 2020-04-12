-- View
DROP VIEW IF EXISTS doc_prf;
CREATE VIEW doc_prf AS
SELECT DISTINCT CONCAT(frst_nm, ' ', mid_nm, ' ', lst_nm, ' ', suffix) AS name, prf_rate, org_nm, pri_spec, city
              FROM provider_info
              INNER JOIN individual_score
              ON provider_info.NPI = individual_score.NPI
              INNER JOIN provider_profession
              ON provider_info.NPI = provider_profession.NPI
              INNER JOIN provider_address
              ON provider_info.NPI = provider_address.NPI;

-- Trigger
DROP TRIGGER IF EXISTS evaluation_before_insert;
DELIMITER  //
CREATE TRIGGER evaluation_before_insert
BEFORE INSERT
ON patient_experience
FOR EACH ROW
BEGIN
	IF NEW.prf_rate > 100 THEN 
		SIGNAL SQLSTATE '22003'
        SET MESSAGE_TEXT = 'The rate is more than 100.' ;
	ELSEIF NEW.prf_rate <0 THEN
		SIGNAL SQLSTATE '22003'
        SET MESSAGE_TEXT = 'The rate is less than 0.' ;
	END IF;
END  //
DELIMITER ;   

           