<?php
  //Pega informações do for e atribui pro php
    require '../vendor/autoload.php';
        $nome = $_POST['nName'];
        $email = $_POST['nEmail'];
        $telefone = $_POST['nTelefone'];
        $empresa = $_POST['nEmpresa'];
        $ramo = $_POST['nRamo'];
        $ferramentas = $_POST['nFerramentas'];
        $falta = $_POST['nFalta'];
        $data_envio = date('d/m/Y');
        $hora_envio = date('H:i:s');

    // Composição do E-mail
    $arquivo = "
      <style type='text/css'>
      body {
      margin:0px;
      font-family:Verdane;
      font-size:12px;
      color: #666666;
      }
      a{
      color: #666666;
      text-decoration: none;
      }
      a:hover {
      color: #FF0000;
      text-decoration: none;
      }
      </style>
        <html>
            <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#00BFFF'>
                <tr>
                  <td>
    
                    <tr>
                     <td width='500'>Nome: <b>$nome</b> </td>
                    </tr>
    
                    <tr>
                      <td width='320'>E-mail: <b>$email</b></td>
                    </tr>
    
                    <tr>
                      <td width='320'>Telefone: <b>$telefone</b></td>
                    </tr>
    
                    <tr>
                      <td width='320'>Empresa: <b>$empresa</b></td>
                    </tr>
    
                    <tr>
                      <td width='320'>Ramo da empresa: <b>$ramo</b></td>
                    </tr>
    
                    <tr>
                      <td width='320'>Ferramentas utilizadas na empresa: <b>$ferramentas</b></td>
                    </tr>
    
                    <tr>
                      <td width='320'>O que falta no software para melhoria: <b>$falta</b></td>
                    </tr>
    
                </td>
              </tr>
              <tr>
                <td>Este e-mail foi enviado em <b>$data_envio</b> as <b>$hora_envio</b></td>
              </tr>
           </table>
        </html>
      ";
    //função que engloba o maller para envio de email
    function enviaEmail($imail,$corpo,$nombre){

        $lmail = new PHPMailer;

        $lmail->isSMTP();
        $lmail->Debugoutput = 'html';
        $lmail->Host = 'smtp.gmail.com';
        $lmail->Port = 587;
        $lmail->SMTPSecure = 'tls';
        $lmail->SMTPAuth = true;
        $lmail->Username = "desafioprocedo@gmail.com";
        $lmail->Password = "procedobauru";
        $lmail->CharSet    = "utf-8";
        $lmail->IsHTML(true);
        $lmail->setFrom('suporte@procedo.com.br', 'Lucas Cegielkowski');
        $lmail->addAddress($imail, $nombre);
        $lmail->Subject = 'Formulário recebido';
        $lmail->msgHTML("$corpo");
        $lmail->AltBody = 'Isto é uma mensgem automática';
          return  $lmail->send();
    }
    //Envia o form para o responsável e chega erros.
       $mail = enviaEmail("lcegielkowski@outlook.com","$arquivo","Felipe Traina");
            if (!$mail) {
                echo "Mailer Error: " . $mail->ErrorInfo;

            } else {
    //envia o email resposta para o cliente
                enviaEmail("$email","<p>Obrigado $nome, o seu formulário é de suma importância para nós.
                                                  <br/> Você já visitou nosso <a href='https://www.procedo.com.br/'
                                                  target='_blank'>site</a>? dá uma corrida lá, é só clicar 
                                                  <a href='https://www.procedo.com.br/' target='_blank'>aqui</a> :D</p>"
                                                   ,"$nome");

                header("Location: http://localhost/DesafioProcedo1/_ProjetoPhp/index.html");
                die();
              }

?>