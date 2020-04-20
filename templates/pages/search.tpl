{include file='header.tpl' page='search'}
<div id="sratna-search">
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
        <div class="row animate-box" id="search-results"></div>
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
    
    var blogPosts = {$lunr_posts|@json_encode};
    var idx = lunr(function () {
      this.ref('id');
      this.field('title');
      this.field('excerpt');
      this.field('date');
      this.field('comments');
      this.field('contents');
      
      this.metadataWhitelist = ['position'];
    
      blogPosts.forEach(function (blogPost) {
        this.add(blogPost);
      }, this);
      
    });
    // console.log(idx.tokenSet.toArray());
    var searchRequest = getUrlParameter('input');
    var searchResults = idx.search(searchRequest);
    var resultNodes = searchResults.map(function createResultNode(result) {
        var resultId = result['ref'];
        
        var resultIndex = blogPosts.findIndex(function findByID(blogPost, index, arr) {
            return blogPost['id']==resultId;
        } );
        
        var positions = result['matchData']['metadata'][searchRequest]['contents']['position'];
        var minBound = 0;
        var maxBound = blogPosts[resultIndex]['contents'].length-1;
        var positionsFlattened = positions.flat();
        var globalLeftBound  = Math.min.apply(null, positionsFlattened),
            globalRightBound = Math.max.apply(null, positionsFlattened);
        var globalLeftBoundExpanded  = Math.max(minBound, globalLeftBound-12),
            globalRightBoundExpanded = Math.min(globalRightBound+12, maxBound);
        var description = (globalLeftBoundExpanded==minBound ? "":"...") + blogPosts[resultIndex]['contents'].substring(globalLeftBoundExpanded, globalRightBoundExpanded) + (globalRightBoundExpanded==maxBound ? "":"...");
            
        var title = blogPosts[resultIndex]['title'];
        var href = $("<a href=\"{'https://'|cat:$smarty.server.HTTP_HOST|cat:'/blog/'}" + result['ref'] + "\"></a>").text(title);
        var titleNode = $("<h3></h3>").append(href);
    
        var partsToBold = positions.map(function getPartToBold(position) {
            return blogPosts[resultIndex]['contents'].substring(position[0], position[1]);
        } );
        partsToBold.forEach(function boldPart(partToBold) {
            description = description.replace(partToBold, "<b>" + partToBold + "</b>");
        } );
        var descriptionNode = $("<p></p>").html(description);
        var resultNode = $("<div class=\"container\"></div>").append(titleNode).append(descriptionNode).append($("<hr>"));
        return resultNode;
    } );
    if (resultNodes.length>0) {
        $("#search-results").append(...resultNodes);
    } else {
        $("#search-results").append($("<p></p>").text("No results found."));
    }
    
</script>
{include file='footer.tpl'}
