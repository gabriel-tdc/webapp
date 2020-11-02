###################  
    How to use  
###################  
  
Configurar a URL Base do projeto, para que todos os links funcionem corretamente:  
`application/config/config.php - Linha 26`  
  
Validar se o arquivo .htaccess está localizado na raiz do projeto, com a seguinte regra:  
`RewriteEngine on`  
`RewriteCond %{REQUEST_FILENAME} !-f`  
`RewriteCond %{REQUEST_FILENAME} !-d`  
`RewriteRule ^(.*)$ index.php?/$1 [QSA,L]`  
  
Configurar a conexão com o banco de dados no seguinte arquivo:  
`application/config/database.php`  
Definir o banco webapp para o funcionamento correto
