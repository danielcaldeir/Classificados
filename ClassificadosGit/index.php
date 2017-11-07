<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript">
            function acao(){
                var area = document.getElementById('area');
                var texto = prompt('Qual o seu nome?');
                
                area.innerHTML = texto;
                document.getElementById('botao').innerHTML = prompt('Qual o nome do botao?');
            }
            function adicionarIngredientes(){
                var valor = document.getElementById("ingrediente").value;
                var listaHTML = document.getElementById("lista").innerHTML;
                
                listaHTML = listaHTML + "<li>" +valor+"</li>";
                document.getElementById("lista").innerHTML = listaHTML;
            }
            function operacao(){
                var x = 3 * 5;
                var y = x + 30;
                var z = y / 2;
                alert("Valor de x = "+x+"-->Valor de y = "+y+"-->Valor de z = "+z);
            }
            function somar(){
                var campo1 = (document.getElementById("campo1").value);
                var campo2 = (document.getElementById("campo2").value);
                var soma = parseInt(campo1) + parseInt(campo2);
                //alert ("Valor do campo1:"+campo1);
                //alert ("Valor do Campo2:"+campo2);
                alert ("Valor da soma:"+soma);
            }
            function loop(x){
                var y = 0;
                var listaHTML = document.getElementById("loop").innerHTML;
                var valor = "Iniciando o LOOP";
                
                listaHTML = listaHTML + "<li>" +valor+"</li>";
                
                while (y < 10){
                    valor = "Numero: "+x+"<br>";
                    listaHTML = listaHTML + "<li>" +valor+"</li>";
                    y++;
                    x++;
                }
                valor = "Finalizando o LOOP";
                listaHTML = listaHTML + "<li>" +valor+"</li>";
                document.getElementById("loop").innerHTML = listaHTML;
            }
        </script>
    </head>
    <body>
        <table>
        <tr>
            <td>
                <table>
                    <tr><td><a id="PagTeste" href="teste.php">teste</a></td></tr>
                    <tr><td>Acessar: <?php echo ($_GET['q']);?></td></tr>
                </table>
                
            </td>
        <td>
            <div id="area">Alguma coisa...</div>
            <br>
            <button id="botao" onclick="acao()">Fazer acao</button>
            <br><br>
            <h2>Envio de dados para o formulario</h2>
            <form id="formulario" method="get" action="teste.php">
                Nome:
                <input type="text" name="nome"  value=""><br>
                Sobrenome:
                <input type="text" name="sobrenome" value=""><br>
                Idade:
                <input type="text" name="idade" value=""><br>
                Sexo
                <input type="radio" name="sexo" value="masculino">Masculino |
                <input type="radio" name="sexo" value="feminino">Feminino<br>
                <input type="submit" id="botaoEnviarForm" value="Enviar">
            </form>
            <br><br>
            <h2>Inserir Usuario e Senha no Banco de Dados</h2>
            <form id="formulario" method="get" action="conexao.php">
                Nome:
                <input type="text" name="nome"  value=""><br>
                E-Mail:
                <input type="text" name="email" value=""><br>
                Senha:
                <input type="password" name="senha" value=""><br>
                Escolha
                <input type="radio" name="escolha" value="Inserir">Inserir |
                <input type="radio" name="escolha" value="Atualizar">Atualizar<br>
                <input type="hidden" name="id" value="2">
                <input type="submit" id="botaoEnviarForm" value="Enviar">
            </form>
            <br><br>
            <h2>Ingredientes do Bolo</h2>
            
            <input type="text" id="ingrediente" />
            <button onclick="adicionarIngredientes()">Adicionar</button>
            <br>
            <ul id="lista">
                <li>Item 1</li>
                <li>Item 2</li>
                <li>Item 3</li>
            </ul>
            <br><br>
            <h2>Operacao</h2>
            <button onclick="operacao()">executar</button>
            <br>
            <input type="text" id="campo1" />
            <input type="text" id="campo2" />
            <button onclick="somar()">executar</button>
            <br><br>
            <h2>WHILE</h2>
            Informe um valor:
            <input type="text" id="valor" name="valor">
            <button onclick="loop(valor.value)">LOOP</button>
            <ul id="loop"></ul>
        </td>
        </tr>
        </table>
    </body>
</html>
