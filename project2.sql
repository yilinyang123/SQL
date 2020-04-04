DROP DATABASE IF EXISTS medication;
CREATE DATABASE medication;
USE medication;


DROP TABLE IF EXISTS org_1_patient;
CREATE TABLE IF NOT EXISTS org_1_patient (
	org_nm			VARCHAR(255),
    org_pac_id		VARCHAR(255),
    state			VARCHAR(255),
    measure_id		VARCHAR(255),
    measure_title	VARCHAR(255),
    prf_rate		VARCHAR(255),
    fn				VARCHAR(255)
);


LOAD DATA INFILE 'C:\\Users\\yasiw\\Desktop\\2020 spring\\data management\\project\\project_2\\data\\Physician_Compare_2015_Group_Public_Reporting_-_Patient_Experience.txt' 
INTO TABLE org_1_patient
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
IGNORE 1 LINES;

DROP TABLE IF EXISTS org_2_group;
CREATE TABLE IF NOT EXISTS org_2_group (
	org_nm			VARCHAR(255),
    org_pac_id		VARCHAR(255),
    state			VARCHAR(255),
    participate_PQR	VARCHAR(255),
    measure_id		VARCHAR(255),
    measure_title	VARCHAR(255),
    invs_msr		VARCHAR(255),
    prf_rate		VARCHAR(255),
    fn				VARCHAR(255),
    collection_type	VARCHAR(255),
    live_site_IND	VARCHAR(255)
);

LOAD DATA INFILE 'C:\\Users\\yasiw\\Desktop\\2020 spring\\data management\\project\\project_2\\data\\Physician_Compare_2015_Group_Public_Reporting___Performance_Scores.txt' 
INTO TABLE org_2_group
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
IGNORE 1 LINES;

DROP TABLE IF EXISTS org_3_ind;
CREATE TABLE IF NOT EXISTS org_3_ind (
	NPI				VARCHAR(255),
	ind_pac_id		VARCHAR(255),
    lst_nm			VARCHAR(255),
    frst_nm			VARCHAR(255),
    measure_id		VARCHAR(255),
    measure_title	VARCHAR(255),
    invs_msr		VARCHAR(255),
    prf_rate		VARCHAR(255),
    collection_type	VARCHAR(255),
    live_site_IND	VARCHAR(255)   
);

LOAD DATA INFILE 'C:\\Users\\yasiw\\Desktop\\2020 spring\\data management\\project\\project_2\\data\\Physician_Compare_2015_Individual_EP_Public_Reporting___Performance_Scores.txt' 
INTO TABLE org_3_ind
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
IGNORE 1 LINES;

DROP TABLE IF EXISTS org_4_prov;
CREATE TABLE IF NOT EXISTS org_4_prov (
	NPI				VARCHAR(255),
	ind_pac_id		VARCHAR(255),
    Ind_enrl_id		VARCHAR(255),
    lst_nm			VARCHAR(255),
    frst_nm			VARCHAR(255),
    mid_nm			VARCHAR(255),
    suffix			VARCHAR(255),
    gender			VARCHAR(255),
    cred			VARCHAR(255),
    Med_sch			VARCHAR(255),
    grad_year		VARCHAR(255),
    pri_spec		VARCHAR(255),
    sec_spec_1		VARCHAR(255),
    sec_spec_2		VARCHAR(255),
    sec_spec_3		VARCHAR(255),
    sec_spec_4		VARCHAR(255),
    sec_spec_all	VARCHAR(255),
    org_nm			VARCHAR(255),
    org_pac_id		VARCHAR(255),
    num_org_mem		VARCHAR(255),
    adr_ln_1		VARCHAR(255),
    adr_ln_2		VARCHAR(255),
    ln_2_sprs		VARCHAR(255),
    city			VARCHAR(255),
    state			VARCHAR(255),
    zip_code		VARCHAR(255),
    phone_num		VARCHAR(255),
    hosp_afl_1		VARCHAR(255),
    hosp_afl_lbn_1	VARCHAR(255),
    hosp_afl_2		VARCHAR(255),
    hosp_afl_lbn_2	VARCHAR(255),
    hosp_afl_3		VARCHAR(255),
    hosp_afl_lbn_3	VARCHAR(255),
    hosp_afl_4		VARCHAR(255),
    hosp_afl_lbn_4	VARCHAR(255),
    hosp_afl_5		VARCHAR(255),
    hosp_afl_lbn_5	VARCHAR(255),
    assgn			VARCHAR(255), 
    quality_measure	VARCHAR(255),
    electronic		VARCHAR(255),
    heart_health	VARCHAR(255)   
);

LOAD DATA INFILE 'C:\\Users\\yasiw\\Desktop\\2020 spring\\data management\\project\\project_2\\data\\new_file.csv' 
INTO TABLE org_4_prov
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
IGNORE 1 LINES;


-- normalization
-- 1. patient_experience
DROP TABLE IF EXISTS patient_experience;
CREATE TABLE patient_experience (
	org_nm		VARCHAR(255),
    measure_id	VARCHAR(40),
    prf_rate	VARCHAR(255),
    fn			VARCHAR(255),
    PRIMARY KEY (org_nm, measure_id)
) ENGINE = InnoDB;

INSERT IGNORE INTO patient_experience
SELECT org_nm, measure_id, prf_rate, fn
FROM org_1_patient;

-- 2. measure
DROP TABLE IF EXISTS measure;
CREATE TABLE measure (
    measure_id		VARCHAR(255),
    measure_title	VARCHAR(255),
    PRIMARY KEY (measure_id)
) ENGINE = InnoDB;

INSERT IGNORE INTO measure
SELECT DISTINCT measure_id, measure_title
FROM org_1_patient;

INSERT IGNORE INTO measure
SELECT DISTINCT measure_id, measure_title
FROM org_2_group;

INSERT IGNORE INTO measure
SELECT DISTINCT measure_id, measure_title
FROM org_3_ind;

-- 3. individual_score
DROP TABLE IF EXISTS individual_score;
CREATE TABLE individual_score (
    NPI				VARCHAR(255),
    ind_pac_id		VARCHAR(255),
    measure_id		VARCHAR(255),
    invs_msr		VARCHAR(255),
    prf_rate		VARCHAR(255),
    collection_type	VARCHAR(255),
    live_site_IND	VARCHAR(255), 
    PRIMARY KEY (NPI)
) ENGINE = InnoDB;

INSERT IGNORE INTO individual_score
SELECT DISTINCT NPI, ind_pac_id, measure_id, invs_msr, prf_rate, collection_type, live_site_IND
FROM org_3_ind;

-- 4. group_score
DROP TABLE IF EXISTS group_score;
CREATE TABLE group_score (
    org_nm			VARCHAR(255),
    participate_PQR	VARCHAR(255),
    measure_id		VARCHAR(255),
    invs_msr		VARCHAR(255),
    prf_rate		VARCHAR(255),
    fn				VARCHAR(255),
    collection_type	VARCHAR(255),
    live_site_IND	VARCHAR(255), 
    PRIMARY KEY (org_nm)
) ENGINE = InnoDB;


INSERT IGNORE INTO group_score
SELECT DISTINCT org_nm, participate_PQR, measure_id, invs_msr, prf_rate, fn, collection_type, live_site_IND
FROM org_2_group;


-- 5. org_info
DROP TABLE IF EXISTS org_info;
CREATE TABLE org_info (
    org_nm		VARCHAR(255),
	org_pac_id	VARCHAR(255),
    PRIMARY KEY (org_nm)
) ENGINE = InnoDB;

INSERT IGNORE INTO org_info
SELECT DISTINCT org_nm, org_pac_id
FROM org_1_patient;

INSERT IGNORE INTO org_info
SELECT DISTINCT org_nm, org_pac_id
FROM org_2_group;

INSERT IGNORE INTO org_info
SELECT DISTINCT org_nm, org_pac_id
FROM org_4_prov;

-- 6. provider_address
DROP TABLE IF EXISTS provider_address;
CREATE TABLE provider_address (
	NPI				VARCHAR(255),
    org_nm			VARCHAR(255),
    num_org_mem		VARCHAR(255),
    adr_ln_1		VARCHAR(255),
    adr_ln_2		VARCHAR(255),
    ln_2_sprs		VARCHAR(255),
    city			VARCHAR(255),
    state			VARCHAR(255),
    zip_code		VARCHAR(255),
    PRIMARY KEY (NPI)
) ENGINE = InnoDB;

INSERT IGNORE INTO provider_address
SELECT DISTINCT NPI, org_nm, num_org_mem, adr_ln_1, adr_ln_2, ln_2_sprs, city, state, zip_code
FROM org_4_prov;

-- 7. sec_spec
DROP TABLE IF EXISTS sec_spec;
CREATE TABLE sec_spec (
	sec_spec_all	VARCHAR(255),
    sec_spec_1		VARCHAR(255),
    sec_spec_2		VARCHAR(255),
    sec_spec_3		VARCHAR(255),
    sec_spec_4		VARCHAR(255),
    PRIMARY KEY (sec_spec_all)
) ENGINE = InnoDB;

INSERT IGNORE INTO sec_spec
SELECT DISTINCT sec_spec_all, sec_spec_1, sec_spec_2, sec_spec_3, sec_spec_4
FROM org_4_prov;   

-- 8. provider_profession
DROP TABLE IF EXISTS provider_profession;
CREATE TABLE provider_profession (
	NPI				VARCHAR(255),
    pri_spec		VARCHAR(255),
    sec_spec_all	VARCHAR(255),
    assgn			VARCHAR(255),
    quality_measure	VARCHAR(255),
    electronic		VARCHAR(255),
    heart_health	VARCHAR(255),
    PRIMARY KEY (NPI)
) ENGINE = InnoDB;

INSERT IGNORE INTO provider_profession
SELECT DISTINCT NPI, pri_spec, sec_spec_all, assgn, quality_measure, electronic, heart_health
FROM org_4_prov;  


-- 9. provider_info
DROP TABLE IF EXISTS provider_info;
CREATE TABLE IF NOT EXISTS provider_info (
	NPI				VARCHAR(255),
	ind_pac_id		VARCHAR(255),
    Ind_enrl_id		VARCHAR(255),
    lst_nm			VARCHAR(255),
    frst_nm			VARCHAR(255),
    mid_nm			VARCHAR(255),
    suffix			VARCHAR(255),
    gender			VARCHAR(255),
    cred			VARCHAR(255),
    Med_sch			VARCHAR(255),
    grad_year		VARCHAR(255),
    phone_num		VARCHAR(255),
    PRIMARY KEY (NPI)
);

INSERT IGNORE INTO provider_info
SELECT DISTINCT NPI, ind_pac_id, Ind_enrl_id, lst_nm, frst_nm, mid_nm, suffix, gender, cred, Med_sch, grad_year,phone_num
FROM org_4_prov;  

