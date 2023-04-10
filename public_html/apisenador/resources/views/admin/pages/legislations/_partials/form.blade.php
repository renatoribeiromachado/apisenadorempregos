@include('admin.includes.alerts')

<style>
    /* Esconde o input */
    input[type='file'] {
        display: none
    }

    /* Aparência que terá o seletor de arquivo */
    .label {
        background-color: green;
        border-radius: 30px;
        color: #fff;
        font-weight: 700 !important;
        cursor: pointer;
        margin: 10px;
        padding: 6px 20px
    }
</style>


<div class="form-group">
    <label>* Título:</label>
    <input type="text" name="title" class="form-control" placeholder="Título:" value="{{ $legislation->title ?? old('title') }}">
</div>

<div class="form-group">
    <label class="label" for="selecao-arquivo"><i class="fa fa-camera"></i> Anexar Imagem</label>
    <input type="file" name="link" id="selecao-arquivo" class="form-control">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark btnSubmit">Enviar</button>
</div>

<script>
    let btnSubmit = document.querySelector('.btnSubmit');
    
    btnSubmit.addEventListener('click', function(){
       btnSubmit.InnerHTML = "Aguarde inserindo";
    });

</script>
