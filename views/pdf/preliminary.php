<?php 
    $this->layout = 'nolayout-pdf'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
    $opportunity = $app->view->jsObject['opp'];
    $claimDisabled = $app->view->jsObject['claimDisabled'];
    include_once('header-pdf.php'); 
?>

<main>
    <div class="container">
        <select class="form-control" id="select-relatory-option">
            <option value="note">Por Nota</option>
            <option value="alfa">Ordem alfabética</option>
        </select>
        <div class="pre-text">Resultado Preliminar</div>
        <div class="opportunity-info">
            <p class="text-opp">Oportunidade</p>
            <h4 class="opp-name-relatorio"><?php echo $nameOpportunity ?></h4>
        </div>
    </div>
    <?php    
        $type = $opportunity->evaluationMethodConfiguration->type->id;
        if($opportunity->registrationCategories == "" &&  ($type == 'technical' || $type == 'technicalna')){
            include_once('technical-no-category.php');
        }elseif($opportunity->registrationCategories == "" &&  $type == 'simple'|| $type == 'documentary'){
            include_once('simple-documentary-no-category.php');
        }elseif($opportunity->registrationCategories !== "" &&  ($type == 'technical' || $type == 'technicalna')){
            include_once('technical-category.php');
        }elseif($opportunity->registrationCategories !== "" &&  $type == 'simple'|| $type == 'documentary'){
            include_once('simple-documentary-category.php');
        }
    ?>
</main>

<script>
    $(document).ready(function() {

        const urlSearchParams = new URLSearchParams(window.location.search);
        const params = Object.fromEntries(urlSearchParams.entries());

        if(params['typeRelatorio']){
            $("#select-relatory-option").val(params['typeRelatorio']);
        }
        $('#select-relatory-option').on('change', function() {
            params['typeRelatorio'] = this.value;
            window.location.href = window.location.origin + window.location.pathname + "?" + jQuery.param(params);
        });
    });
</script>
