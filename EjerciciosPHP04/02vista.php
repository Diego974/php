<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="default.css" rel="stylesheet" type="text/css" />
<style>
    body {
        background: linear-gradient(135deg, #6dd5ed 0%, #2193b0 100%);
        font-family: 'Segoe UI', Arial, sans-serif;
        min-height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #container {
        width: 400px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        margin: 40px auto;
        padding-bottom: 24px;
    }
    #header {
        background: #001aff;
        color: #fff;
        padding: 18px 0 10px 0;
        border-radius: 12px 12px 0 0;
        text-align: center;
        margin-bottom: 18px;
    }
    #header h1 {
        margin: 0;
        font-size: 2em;
        font-weight: bold;
        letter-spacing: 1px;
    }
    #content {
        padding: 0 28px;
    }
    form {
        margin-top: 10px;
    }
    input[type="text"] {
        margin-bottom: 8px;
        border-radius: 6px;
        border: 1px solid #b2bec3;
        padding: 6px 10px;
        font-size: 1em;
        width: 90px;
        background: #f7f7f7;
        transition: border-color 0.2s;
    }
    input[type="text"]:focus {
        border-color: #2193b0;
        outline: none;
    }
    fieldset {
        border: 1px solid #e3e3e3;
        border-radius: 8px;
        margin-bottom: 14px;
        padding: 10px 14px;
        display: inline-block;
        background: #f4f8fb;
    }
    button {
        font-size: 1em;
        padding: 7px 16px;
        margin-right: 6px;
        border: none;
        border-radius: 6px;
        background: #2193b0;
        color: #fff;
        cursor: pointer;
        transition: background 0.2s;
    }
    button[type="button"] {
        background: #b2bec3;
        color: #222;
    }
    button:hover {
        background: #17668a;
    }
    button[type="button"]:hover {
        background: #636e72;
        color: #fff;
    }
    input[type="radio"] {
        accent-color: #001aff;
        margin-right: 4px;
        margin-left: 10px;
    }
    label[for="resultado"] {
        font-weight: bold;
        margin-top: 8px;
        display: block;
        color: #2193b0;
    }
    textarea#resultado {
        width: 100%;
        margin-bottom: 8px;
        resize: none;
        font-size: 1.1em;
        background: #f7f7f7;
        border-radius: 6px;
        border: 1px solid #b2bec3;
        padding: 8px;
        color: #222;
    }
    input[type="reset"] {
        background: #b2bec3;
        color: #222;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-size: 1em;
        cursor: pointer;
        margin-top: 8px;
        transition: background 0.2s;
    }
    input[type="reset"]:hover {
        background: #636e72;
        color: #fff;
    }
</style>
</head>
<script>
// No se puede borrar con el reset si tiene value fijados 
function borrarvalores(){
    document.getElementsByName('num1')[0].value = "";
    document.getElementsByName('num2')[0].value = "";
    document.getElementsByName('resultado')[0].value = "";
}
</script>
<body>
    <div id="container">
    <div id="header">
        <h1>Mini Calculadora</h1>
    </div>
    <div id="content">
    <form method="get" action="02.php">
    Nº1:<input type="text" name="num1" size=10 value="<?= isset($num1)?$num1:''?>">
    <br>
    Nº2:<input type="text" name="num2" size=10 value="<?=isset($num2)?$num2:''?>">
    <br>
    <fieldset>
    <button name='operacion' value='+'> +</button>
    <button name='operacion' value='-'> -</button>
    <button name='operacion' value='*'> *</button>
    <button name='operacion' value='/'> /</button>
    <button name='borrar' value="Borrar" type="button" onclick='borrarvalores()' >Borrar</button>
    </fieldset>
    <br>
    <fieldset>
    <input type="radio" name="formato" value="dec" 
        <?=(!isset($formato) || $formato =="dec")? "checked='checked'":""?> >Decimal 
    <input	type="radio" name="formato" value="bin"
        <?=(isset($formato)  && $formato =="bin")? "checked='checked'":""?> >Binario 
    <input type="radio" name="formato" value="hex"
        <?=(isset($formato)  && $formato =="hex")? "checked='checked'":""?> >Hexadecimal<br>
    </fieldset>
    <br>
    <label for="resultado">Resultado:</label>
    <textarea name="resultado" id="resultado" rows="2" cols="35" readonly><?= isset($msg)?$msg:""?></textarea>
    <br>
    <input type="reset" value=" borrar con reset ">
    </form>
    </div>
    </div>
</body>
</html>
