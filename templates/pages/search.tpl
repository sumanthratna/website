{include file='header.tpl' page='search'}
<div id="sratna-contact">
	<div class="container">
		<div class="row text-center">
			<h2 class="bold">Search</h2>
		</div>
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-center animate-box intro-heading">
				<span>Search</span>
				<h2>Results</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="rotate">
					<h2 class="heading">Search</h2>
				</div>
			</div>
		</div>
		<div class="row animate-box">
			UNDER CONSTRUCTION
		</div>
	</div>
</div>
<script src="https://unpkg.com/lunr/lunr.js"></script>
<script>
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

var documents = {$lunr_posts|@json_encode};
var idx = lunr(function () {
  this.ref('id');
  this.field('title');
  this.field('excerpt');
  this.field('date');
  this.field('comments');
  this.field('contents');

  documents.forEach(function (doc) {
    this.add(doc)
  }, this)
  
});
// console.log(idx.tokenSet.toArray());
var searchRequest = getUrlParameter('input');
console.log(idx.search(searchRequest));
</script>

{include file='footer.tpl'}
