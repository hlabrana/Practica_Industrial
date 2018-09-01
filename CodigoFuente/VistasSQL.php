SELECT grupo,SUM(importe) as Vigente FROM OUTPUT WHERE tramo='Vigente' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as '1-30 dias' FROM OUTPUT WHERE tramo='1-30 dias' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as '31-60 dias' FROM OUTPUT WHERE tramo='31-60 dias' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as '61-90 dias' FROM OUTPUT WHERE tramo='61-90 dias' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as '91-120 dias' FROM OUTPUT WHERE tramo='91-120 dias' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as '121-150 dias' FROM OUTPUT WHERE tramo='121-150 dias' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as '151-180 dias' FROM OUTPUT WHERE tramo='151-180 dias' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as '181-365 dias' FROM OUTPUT WHERE tramo='181-365 dias' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as '1-3 años' FROM OUTPUT WHERE tramo='1-3 años' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as '3-5 años' FROM OUTPUT WHERE tramo='3-5 años' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as 'mas de 5 años' FROM OUTPUT WHERE tramo='mas de 5 años' GROUP BY grupo ORDER BY SUM(importe) DESC
SELECT grupo,SUM(importe) as 'totalgeneral' FROM OUTPUT GROUP BY grupo ORDER BY SUM(importe) DESC

SELECT tres.grupo,uno.Vigente,dos.treinta FROM (SELECT grupo,SUM(importe) as Vigente FROM OUTPUT WHERE tramo='Vigente' GROUP BY grupo ORDER BY SUM(importe) DESC) AS uno,
(SELECT grupo,SUM(importe) as treinta FROM OUTPUT WHERE tramo='1-30 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos,
(SELECT grupo FROM OUTPUT GROUP BY grupo) AS tres WHERE (tres.grupo=uno.grupo AND tres.grupo=dos.grupo)



//SUB CONSULTAS SQL - GRUPO y TRAMO
SELECT uno.grupo,dos.Vigente FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as Vigente FROM OUTPUT WHERE tramo='Vigente' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.Vigente DESC

SELECT uno.grupo,dos.treinta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as treinta FROM OUTPUT WHERE tramo='1-30 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.treinta DESC

SELECT uno.grupo,dos.sesenta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as sesenta FROM OUTPUT WHERE tramo='31-60 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.sesenta DESC

SELECT uno.grupo,dos.noventa FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as noventa FROM OUTPUT WHERE tramo='61-90 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.noventa DESC

SELECT uno.grupo,dos.cienveinte FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as cienveinte FROM OUTPUT WHERE tramo='91-120 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.cienveinte DESC

SELECT uno.grupo,dos.ciencincuenta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as ciencincuenta FROM OUTPUT WHERE tramo='121-150 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.ciencincuenta DESC

SELECT uno.grupo,dos.cienochenta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as cienochenta FROM OUTPUT WHERE tramo='151-180 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.cienochenta DESC

SELECT uno.grupo,dos.treseiscinco FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as treseiscinco FROM OUTPUT WHERE tramo='181-365 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.treseiscinco DESC

SELECT uno.grupo,dos.tresanios FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as tresanios FROM OUTPUT WHERE tramo='1-3 años' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.tresanios DESC

SELECT uno.grupo,dos.cincoanios FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as cincoanios FROM OUTPUT WHERE tramo='3-5 años' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.cincoanios DESC

SELECT uno.grupo,dos.mascinco FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as mascinco FROM OUTPUT WHERE tramo='mas de 5 años' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.mascinco DESC

SELECT uno.grupo,dos.totalgeneral FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as totalgeneral FROM OUTPUT GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.totalgeneral DESC

//ESTRUCTURA VISTA FINAL SQL
SELECT primero.grupo,Vigente,treinta,sesenta
FROM
() AS primero
JOIN
() AS segundo
ON primero.grupo=segundo.grupo
JOIN
() AS tercero
ON primero.grupo=tercero.grupo
JOIN
() AS cuarto
ON primero.grupo=cuarto.grupo
JOIN
() AS quinto
ON primero.grupo=quinto.grupo
JOIN
() AS sexto
ON primero.grupo=sexto.grupo
JOIN
() AS septimo
ON primero.grupo=septimo.grupo
JOIN
() AS octavo
ON primero.grupo=octavo.grupo
JOIN
() AS noveno
ON primero.grupo=noveno.grupo
JOIN
() AS decimo
ON primero.grupo=decimo.grupo
JOIN
() AS undecimo
ON primero.grupo=undecimo.grupo
JOIN
() AS duodecimo
ON primero.grupo=duodecimo.grupo

//VISTA FINAL SQL

SELECT primero.grupo AS 'Grupo',
Vigente AS 'Vigente',
treinta AS '1-30 dias',
sesenta AS '31-60 dias',
noventa AS '61-90 dias',
cienveinte AS '91-120 dias',
ciencincuenta AS '121-150 dias',
cienochenta AS '151-180 dias',
treseiscinco AS '181-365 dias',
tresanios AS '1-3 años',
cincoanios AS '3-5 años',
mascinco AS 'mas de 5 años',
totalgeneral AS 'Total General'
FROM
(SELECT uno.grupo,dos.Vigente FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as Vigente FROM OUTPUT WHERE tramo='Vigente' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.Vigente DESC
) AS primero
JOIN
(SELECT uno.grupo,dos.treinta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as treinta FROM OUTPUT WHERE tramo='1-30 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.treinta DESC
) AS segundo
ON primero.grupo=segundo.grupo
JOIN
(SELECT uno.grupo,dos.sesenta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as sesenta FROM OUTPUT WHERE tramo='31-60 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.sesenta DESC
) AS tercero
ON primero.grupo=tercero.grupo
JOIN
(SELECT uno.grupo,dos.noventa FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as noventa FROM OUTPUT WHERE tramo='61-90 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.noventa DESC
) AS cuarto
ON primero.grupo=cuarto.grupo
JOIN
(SELECT uno.grupo,dos.cienveinte FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as cienveinte FROM OUTPUT WHERE tramo='91-120 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.cienveinte DESC
) AS quinto
ON primero.grupo=quinto.grupo
JOIN
(SELECT uno.grupo,dos.ciencincuenta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as ciencincuenta FROM OUTPUT WHERE tramo='121-150 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.ciencincuenta DESC
) AS sexto
ON primero.grupo=sexto.grupo
JOIN
(SELECT uno.grupo,dos.cienochenta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as cienochenta FROM OUTPUT WHERE tramo='151-180 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.cienochenta DESC
) AS septimo
ON primero.grupo=septimo.grupo
JOIN
(SELECT uno.grupo,dos.treseiscinco FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as treseiscinco FROM OUTPUT WHERE tramo='181-365 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.treseiscinco DESC
) AS octavo
ON primero.grupo=octavo.grupo
JOIN
(SELECT uno.grupo,dos.tresanios FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as tresanios FROM OUTPUT WHERE tramo='1-3 años' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.tresanios DESC
) AS noveno
ON primero.grupo=noveno.grupo
JOIN
(SELECT uno.grupo,dos.cincoanios FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as cincoanios FROM OUTPUT WHERE tramo='3-5 años' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.cincoanios DESC
) AS decimo
ON primero.grupo=decimo.grupo
JOIN
(SELECT uno.grupo,dos.mascinco FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as mascinco FROM OUTPUT WHERE tramo='mas de 5 años' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.mascinco DESC
) AS undecimo
ON primero.grupo=undecimo.grupo
JOIN
(SELECT uno.grupo,dos.totalgeneral FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as totalgeneral FROM OUTPUT GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.totalgeneral DESC
) AS duodecimo
ON primero.grupo=duodecimo.grupo
GROUP BY totalgeneral DESC
