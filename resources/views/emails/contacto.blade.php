<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Nova mensagem de contacto</title>
<style>
  body{font-family:Arial,Helvetica,sans-serif;background:#f4f6f7;margin:0;padding:24px;color:#1a2b2d}
  .wrap{max-width:600px;margin:0 auto;background:#fff;border-radius:10px;overflow:hidden;border:1px solid #e2e8e7}
  .head{background:#0e3a3b;color:#fff;padding:18px 24px}
  .head h1{margin:0;font-size:18px}
  .body{padding:24px}
  .item{margin-bottom:14px}
  .item small{display:block;font-size:11px;text-transform:uppercase;letter-spacing:.05em;color:#8aa09e;margin-bottom:2px}
  .item p{margin:0;font-size:14px;color:#1a2b2d}
  .foot{padding:14px 24px;background:#f4f6f7;font-size:12px;color:#8aa09e}
</style>
</head>
<body>
  <div class="wrap">
    <div class="head"><h1>Nova mensagem de contacto</h1></div>
    <div class="body">
      <div class="item"><small>Nome</small><p>{{ $dados['nome'] }}</p></div>
      @if(!empty($dados['empresa']))
        <div class="item"><small>Empresa</small><p>{{ $dados['empresa'] }}</p></div>
      @endif
      <div class="item"><small>Email</small><p>{{ $dados['email'] }}</p></div>
      @if(!empty($dados['telefone']))
        <div class="item"><small>Telefone</small><p>{{ $dados['telefone'] }}</p></div>
      @endif
      @if(!empty($dados['assunto']))
        <div class="item"><small>Assunto</small><p>{{ $dados['assunto'] }}</p></div>
      @endif
      @if(!empty($dados['servico']))
        <div class="item"><small>Serviço de interesse</small><p>{{ $dados['servico'] }}</p></div>
      @endif
      <div class="item"><small>Mensagem test</small><p style="white-space:pre-line">{{ $dados['mensagem'] }}</p></div>
    </div>
    <div class="foot">Enviado através do formulário de contacto do site.</div>
  </div>
</body>
</html>
