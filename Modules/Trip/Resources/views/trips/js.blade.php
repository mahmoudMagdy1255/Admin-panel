<script>
  $(document).ready(function () {
    $('#countTitleLettrs').keyup(function() {
      // append them to a span
      $('#titleSpan').text('Number of Characters ' + this.value.length).css('color', 'green');
    })

    $('#countDescLettrs').keyup(function() {
      // append them to a span
      $('#descSpan').text('Number of Characters ' + this.value.length).css('color', 'green');
    })

    $('#countKeyWords').keyup(function() {
      // append them to a span
      $('#tagsSpan').text('Number of Characters ' + this.value.length).css('color', 'green');
    })
  });

</script>
