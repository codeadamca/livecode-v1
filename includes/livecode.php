
<script>
    
  function livecodeStatus() {

    fetch('https://livecode.codeadam.ca/api.php?date')
      .then(function(response) {
        return response.json();
      })
      .then(function(json) {
        if (json.count > 0)
        {
          document.getElementById('livecode-current').style.display = 'block';
        }
      });

  }

  window.onload = function(e) {
    livecodeStatus();
  };

</script>

<div id="livecode-current" style="display: none;">


  <hr>

  <h2 class="notification">
    <a href="https://livecode.codeadam.ca/code.html">
      <i class="fas fa-exclamation-triangle"></i>
      Adam is coding! Watch now!        
    </a>
  </h2>


</div>