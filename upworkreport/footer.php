<script src="js/functions.js?v=1.0"></script>

<style>
  a.contact-email {
    display: block;
    height: 29px;
    line-height: 29px;
    color: #FFF;
    background-color: rgba(0, 0, 0, 0.15);
    padding: 0 10px;
    float: right;
  }
</style>
<script>
$(function() {
  setTimeout(function() {
    $("body > div > a").each(function() {
      if ($(this).attr('title').indexOf("000webhost.com") > 0) {
        $(this).attr('title', "Please contact me.");
        $(this).attr('href', "mailto:wenzhe@email.com");
        $(this).html('<img src="img/icon/message.png" />&nbsp;&nbsp;wenzhe@email.com');
        $(this).addClass("contact-email");
      }
    });
  }, 1500);
});
</script>
</body>
</html>
