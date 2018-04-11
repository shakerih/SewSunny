
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

  <?php //require './header.php';?>
<?php
    include('header.php');
    if(!is_logged_in()){
      header("Location: index.php");
    }
?>

<div class="header_space"></div>
<div class="content_container">
    <form id="all" name="all" action="processing.php" method="post">

        <fieldset>
        <h2>The Basics</h2> <p>*indicates required fields</p>
        <div class="post_wrapper">
            <!-- display error -->
            <?php if (isset($_GET['errors'])) { //read error from URL?>
                <span style="color:red">
                    <?php echo str_replace(",","<br>",$_GET['errors'])."<br>"; ?>
                </span>
            <?php } ?>

            <div class="post_left">
                <h3>Project Title *</h3>
                <input type="text" name="title" autofocus>

                <h3>Short Description *</h3>
                <textarea name="shortdes" rows="5" id="shortdes" form="all" placeholder="Enter description here..." ></textarea>
                <h3>Tags</h3>
                <input type="text" name="tags" >
                <hr>

                <h3 id="mainstep"> Instructions *</h3>
                <input type="button" id="stepAdd" value="Add Step" class="bt" />
            </div>
            <div class="post_right">
                <h3>Project Image URL *</h3>
                <input type="text" name="purl" >
                <h3>Category *</h3>
                <select name="category" size="0" >
                    <option value="" selected>-- Select One --</option>
                    <option value="CAT_0">Crochet</option>
                    <option value="CAT_1">Cross Stick</option>
                    <option value="CAT_2">Sewing</option>
                    <option value="CAT_3">Knitting</option>
                </select>
                <h3>Difficulty *</h3>
                <select name="difficulty" size="0" >
                    <option value="0" selected>Easy</option>
                    <option value="1">Intermediate</option>
                    <option value="2">Difficult</option>
                </select>

                <h3 id="main">Tools and Materials *</h3>
                <input type="button" id="btAdd" value="Add Item" class="bt" />
            </div>
            <div class="post_left">
                <input type="submit" name="submit" value="SUBMIT POST">
            </div>
      </div>
    </form>
</div>


<script>
    $(document).ready(function() {

        var iCnt = 0;
        var sCnt = 0;
        // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
        var container = $(document.createElement('div'));

        $('#btAdd').click(function() {

              console.log(container);

                iCnt = iCnt + 1;

                // ADD TEXTBOX.
                $(container).append('Material '+iCnt+' <br><input type="number" name="'+iCnt+'quant" value="enter quantity"><select name="'+iCnt+'units" size="0" ><option value="pounds" selected>lbs</option><option value="cm">cm</option><option value="meter">meters</option><option value="pcs">pcs</option> <option value="rolls">rolls</option><option value="kg">kg</option><option value="items">items</option><option value="mm">mm</option></select><input type="text" name="'+iCnt+'name" value="material name"><br>');


                // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                $('#main').after(container);

        });

          var scontainer = $(document.createElement('div'));
    $('#stepAdd').click(function() {

              console.log(scontainer);

                sCnt = sCnt + 1;

                // ADD TEXTBOX.
                $(scontainer).append('Step '+sCnt+' <br><textarea name="'+sCnt+'inst"  rows="8" placeholder="Enter instructions here..." ></textarea>Image URL<input type="text" name="'+sCnt+'url" ><br>');


                // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                $('#mainstep').after(scontainer);

        });
  })
    // PICK THE VALUES FROM EACH TEXTBOX WHEN "SUBMIT" BUTTON IS CLICKED.
    var divValue, values = '';

    function GetTextValue() {
        $(divValue)
            .empty()
            .remove();

        values = '';

        $('.input').each(function() {
            divValue = $(document.createElement('div')).css({
                padding:'5px', width:'200px'
            });
            values += this.value + '<br />'
        });

        $(divValue).append('<p><b>Your selected values</b></p>' + values);
        $('body').append(divValue);
    }
</script>
