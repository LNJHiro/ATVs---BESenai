-- ATV-1
SHOW TABLES;

-- ATV-2

SHOW TABLE ducks;

-- ATV-3

SELECT * FROM ducks;

-- ATV-4

SELECT * FROM ducks WHERE age <=2;

-- ATV-5

SELECT * FROM ducks ORDER BY age;

-- ATV-6

SELECT * FROM ducks ORDER BY age LIMIT 3;

-- ATV-7

SELECT name, age * 12 AS age_in_months FROM ducks;

-- ATV-8    

SELECT DISTINCT species FROM ducks;

-- ATV-9

SELECT * FROM duck_surveys USING SAMPLE 10;

-- ATV-10

SELECT COUNT(*), AVG(age), MIN(age), MAX(age) FROM ducks;