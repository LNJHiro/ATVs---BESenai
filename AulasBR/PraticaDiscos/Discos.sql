CREATE DATABASE IF NOT EXISTS PraticaDiscos;

USE PraticaDiscos;

-- Apenas uma tabela para começar
CREATE TABLE discos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    artista VARCHAR(150) NOT NULL,
    ano_lancamento INT,
    genero VARCHAR(100)
);

SELECT * FROM discos;

INSERT INTO discos (titulo, artista, ano_lancamento, genero) VALUES
('The Dark Side of the Moon', 'Pink Floyd', 1973, 'Rock Progressivo'),
('Shout at the Devil', 'Mötley Crüe', 1983, 'Heavy Metal'),
('Back in Black', 'AC/DC', 1980, 'Hard Rock'),
('Master of Puppets', 'Metallica', 1986, 'Thrash Metal'),
('Appetite for Destruction', 'Guns N'' Roses', 1987, 'Hard Rock'),
('Nevermind', 'Nirvana', 1991, 'Grunge');

SELECT * FROM discos;

SELECT MIN(id) as id, titulo, artista, COUNT(*) as duplicatas 
FROM discos 
GROUP BY titulo, artista 
HAVING COUNT(*) > 1;

DELETE FROM discos 
WHERE titulo = 'Chromakopia' 
  AND artista = 'Tyler, the creator' 
  AND id NOT IN (
    SELECT MIN(id) 
    FROM (SELECT * FROM discos) AS temp
    WHERE titulo = 'Chromakopia' AND artista = 'Tyler, the creator'
  );

  SELECT * FROM discos;