<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class conexao {
    
    const dsn = "mysql:dbname=blog;host=127.0.0.1";
    const dbuser = "root";
    const dbpass = "root";
    protected $pdo;
    protected $numRows;
    protected $array;
    
    public function __construct() {
        $this->conecte();
    }
    
    public function conectar($dsn,$dbuser,$dbpass){
        try {
            $this->pdo = new PDO($dsn, $dbuser, $dbpass);
            
            return $this->pdo;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function conecte(){
        try {
            $dsn = constant('self::dsn');
            $dbuser = constant('self::dbuser');
            $dbpass = constant('self::dbpass');
            $this->pdo = new PDO($dsn, $dbuser, $dbpass);
            return $this->pdo;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function numRows(){
        return $this->numRows;
    }
    
    public function result(){
        return $this->array;
    }
    
    public function query($sql){
        $query = $this->pdo->query($sql);
        $this->numRows = $query->rowCount();
        if ($this->numRows == 1){
            $this->array = $query->fetch();
        } else {
            $this->array = $query->fetchALL();
        }
        //echo ("Array: ".$this->array."<br>");
        //echo ("sql: ".$sql."<br>");
    }
    
    public function selecionarTabelasDifWhere($tabela, $colunas, $where = array(), $where_cond = "AND", $groupBy = array()) {
        if (!empty($tabela) && (is_array($colunas) && count($colunas)>0 ) ){
            $sql = "SELECT ";
            $sql = $sql.implode(", ", $colunas);
            $sql = $sql." FROM ".$tabela;
            if (count($where) > 0) {
                $dados = array();
                foreach ($where as $valor) {
                    $dados[] = addslashes($valor);
                }
                $sql = $sql." WHERE ";
                $sql = $sql.implode(" ".$where_cond." ", $dados);
            }
            if (count($groupBy) > 0) {
                $sql = $sql.implode(" ", $groupBy);
            }
            //echo $sql;
            $this->query($sql);
        }
    }
    
    public function selecionarTabelas($tabela, $colunas, $where = array(), $where_cond = "AND", $groupBy = array()) {
        if (!empty($tabela) && (is_array($colunas) && count($colunas)>0 ) ){
            $sql = "SELECT ";
            $sql = $sql.implode(", ", $colunas);
            $sql = $sql." FROM ".$tabela;
            if (count($where) > 0) {
                $dados = array();
                foreach ($where as $chave => $valor) {
                    $dados[] = $chave." = '".addslashes($valor)."'";
                }
                $sql = $sql." WHERE ";
                $sql = $sql.implode(" ".$where_cond." ", $dados);
            }
            if (count($groupBy) > 0) {
                $sql = $sql.implode(" ", $groupBy);
            }
            //echo $sql;
            $this->query($sql);
        }
    }
    
    public function insert($table, $data){
        if (!empty($table) && (is_array($data) && count($data)>0 ) ){
            $sql = "INSERT INTO ".$table." SET ";
            $dados = array();
            foreach ($data as $chave => $valor) {
                $dados[] = $chave." = '".addslashes($valor)."'";
            }
            $sql = $sql.implode(", ", $dados);
            //echo $sql;
            try {
                $this->pdo->query($sql);
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
                echo ("<br><br>");
                echo $exc->getMessage();
            }
        }
    }
    
    public function update($table, $data, $where = array(), $where_cond = "AND"){
        if (!empty($table) && (is_array($data) && count($data)) && is_array($where)){
            $sql = "UPDATE ".$table." SET ";
            $dados = array();
            foreach ($data as $chave => $valor) {
                $dados[] = $chave." = '".addslashes($valor)."'";
            }
            $sql = $sql.implode(", ", $dados);
            if (count($where) > 0) {
                $dados = array();
                foreach ($where as $chave => $valor) {
                    $dados[] = $chave." = '".addslashes($valor)."'";
                }
                $sql = $sql." WHERE ";
                $sql = $sql.implode(" ".$where_cond." ", $dados);
            }
            //echo $sql;
            return $this->pdo->query($sql);
        }
    }
    
    public function delete($table, $where = array(), $where_cond = "AND"){
        if (!empty($table) && is_array($where)){
            $sql = "DELETE FROM ".$table;
            if (count($where) > 0) {
                $dados = array();
                foreach ($where as $chave => $valor) {
                    $dados[] = $chave." = '".addslashes($valor)."'";
                }
                $sql = $sql." WHERE ";
                $sql = $sql.implode(" ".$where_cond." ", $dados);
            }
            //echo $sql;
            $this->pdo->query($sql);
        }
    }
    
//    public function selecionarUser($id){
//        try {
//            $sql = "SELECT id, nome, email, senha FROM usuarios where id = :id";
//            $stmt = $this->pdo->prepare($sql);
//            $stmt->bindValue(":id", $id);
//            $stmt->execute();
//            $this->numRows = $stmt->rowCount();
//            $this->array = $stmt->fetch();
//            return $this->array;
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//            echo '<br>';
//            echo $exc->getMessage();
//        }
//    }
    
//    public function selecionarEmailSenha($email, $senha){
//        try {
//            $sql = "SELECT * FROM usuarios where email = :email and senha = :senha";
//            $stmt = $this->pdo->prepare($sql);
//            $stmt->bindParam(":email", $email);
//            $stmt->bindParam(":senha", $senha);
//            $stmt->execute();
//            $this->numRows = $stmt->rowCount();
//            $this->array = $stmt->fetch();
//            return $this->array;
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//            echo '<br>';
//            echo $exc->getMessage();
//        }
//    }
    
//    public function selecionarALLUser(){
//        try {
//            $sql = "SELECT * FROM usuarios";
//            $query = $this->pdo->query($sql);
//            $this->numRows = $query->rowCount();
//            $this->array = $query->fetchAll();
//            return $query;
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//            echo '<br>';
//            echo $exc->getMessage();
//        }
//    }
    
//    public function incluirNomeEmailSenha($nome, $email, $senha){
//        try {
//            $sql = "INSERT INTO usuarios SET nome=?, email=?, senha=?, status=?";
//            $stmt = $this->pdo->prepare($sql);
//            $stmt->execute(array($nome, $email, md5($senha), 0));
//            $this->query("SELECT LAST_INSERT_ID() as ID");
//            return $this->array;
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//            echo '<br>';
//            echo $exc->getMessage();
//        }
//    }
    
//    public function confirmarEmail($id) {
//        try {
//            $sql = "UPDATE usuarios SET status = '1' WHERE md5(id) = ?";
//            $stmt = $this->pdo->prepare($sql);
//            $stmt->execute(array($id));
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//        }
//    }
    
//    public function atualizarNomeEmailSenha($id, $nome, $email, $senha){
//        try {
//            if (empty($nome)){ $UptNome = ""; }
//            else{  $UptNome = "nome = '$nome'"; }
//            if (empty($email)){ $UptEmail = ""; }
//            else{  $UptEmail = "email = '$email'"; }
//            if (empty($senha)){ $UptSenha = ""; }
//            else{  $UptSenha = "senha = md5('$senha')"; }
//            $sql = "UPDATE usuarios SET $UptNome, $UptEmail, $UptSenha where id = $id";
//            return $this->pdo->query($sql);
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//            echo '<br>';
//            echo $exc->getMessage();
//        }
//    }
    
    public function deletarUser($id){
        try {
            $sql = "DELETE FROM usuarios where id = '$id'";
            return $this->pdo->query($sql);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function incluirPost($post){
        try {
            $titulo = $post['titulo'];
            $data = $post['data'];
            $corpo = $post['corpo'];
            $autor = $post['autor'];
            
            $sql = "INSERT INTO posts SET titulo='$titulo', data_criado='$data', corpo='$corpo', autor='$autor'";
            $query = $this->pdo->query($sql);
            return $this->pdo->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function atualizarPost($id, $post){
        try {
            $titulo = $post['titulo'];
            $data = $post['data'];
            $corpo = $post['corpo'];
            $autor = $post['autor'];
            if (empty($titulo)){ $UptTitulo = ""; }
            else{  $UptTitulo = "titulo = '$titulo'"; }
            if (empty($data)){ $UptData = ""; }
            else{  $UptData = "data_criado = '$data'"; }
            if (empty($corpo)){ $UptCorpo = ""; }
            else{  $UptCorpo = "corpo = '$corpo'"; }
            if (empty($autor)){ $UptAutor = ""; }
            else{  $UptAutor = "autor = '$autor'"; }
            $sql = "UPDATE posts SET $UptAutor, $UptTitulo, $UptData, $UptCorpo where id = $id";
            return $this->pdo->query($sql);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function deletarPost($id){
        try {
            $sql = "DELETE FROM posts where id = '$id'";
            return $this->pdo->query($sql);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
//    public function selecionarPosts($post){
//        try {
//            $id = $post['id'];
//            $titulo = $post['titulo'];
//            $data = $post['data'];
//            $corpo = $post['corpo'];
//            $autor = $post['autor'];
            
//            $sql = "SELECT id, titulo, data_criado, corpo, autor FROM posts where id = :id";
//            $stmt = $this->pdo->prepare($sql);
//            $stmt->bindValue(":id", $id);
//            $stmt->execute();
//            $this->numRows = $stmt->rowCount();
//            $this->array = $stmt->fetchALL();
//            return $this->array;
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//            echo '<br>';
//            echo $exc->getMessage();
//        }
//    }
    
//    public function selecionarPostsAutor($post){
//        try {
//            $id = $post['id'];
//            $titulo = $post['titulo'];
//            $data = $post['data'];
//            $corpo = $post['corpo'];
//            $autor = $post['autor'];
            
//            $sql = "SELECT * FROM posts WHERE autor = ?";
//            $stmt = $this->pdo->prepare($sql);
//            $stmt->execute(array($autor));
//            $this->numRows = $stmt->rowCount();
//            $this->array = $stmt->fetchALL();
//            return $this->array;
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//            echo '<br>';
//            echo $exc->getMessage();
//        }
//    }
    
//    public function selecionarALLPosts(){
//        try {
//            $sql = "SELECT * FROM posts";
//            $query = $this->pdo->query($sql);
//            $this->numRows = $query->rowCount();
//            $this->array = $query->fetchAll();
//            return $query;
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//            echo '<br>';
//            echo $exc->getMessage();
//        }
//    }
    
//    public function selecionarALLMSG($id = null) {
//        try {
//            if (is_null($id)){
//                $sql = "SELECT * FROM mensagens ORDER BY data_msg DESC";
//            } else {
//                $sql = "SELECT * FROM mensagens WHERE id_posts = '$id' ORDER BY data_msg DESC";
//            }
//            $this->query($sql);
//            return $this->array;
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//        }
//    }
    
//    public function incluirMSG($msg) {
//        if (is_array($msg)){
//            $id_posts = $msg['id_posts'];
//            $nome = $msg['nome'];
//            $mensagem = $msg['msg'];
            
//            $sql = "INSERT INTO mensagens SET id_posts=?, data_msg=now(), nome=?, msg=?";
//            $stmt = $this->pdo->prepare($sql);
//            print_r($sql);
//            $valor = $stmt->execute(array ($id_posts, $nome, $mensagem));
//            return $valor;
//        }
//    }
}
