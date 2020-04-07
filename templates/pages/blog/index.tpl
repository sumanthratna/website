{include file='header.tpl' page='blog'}
<div id="sratna-blog">
  <div class="container">
    <div class="row text-center">
      <h2 class="bold">Blog</h2>
    </div>
    <div class="row">
      <div
        class="col-md-12 col-md-offset-0 text-center animate-box intro-heading fadeInUp animated"
      >
        <span>Blog</span>
        <h2>Random Thoughts</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="rotate">
          <h2 class="heading">My Blog</h2>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {foreach from=$posts key=id item=post}
                {if $post@iteration is not div by 2 and $post@iteration is not div by 3}
                    {assign var=post_url value={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/blog/'|cat:$id}}
                    {assign var=img_url value=$post.image}
                    {assign var=post_date value=$post.date}
                    {assign var=post_title value=$post.title}
                    {assign var=post_excerpt value=$post.excerpt}
                    <div class="article animate-box fadeInUp animated">
                      <a href={$post_url} class="blog-img">
                        {*{html_image file=$img_url class="img-fluid" alt="" loading="lazy"}*}
                        <img src={$img_url} class="img-fluid" alt="" loading="lazy">
                        <div class="overlay"></div>
                        <div class="link">
                          <span class="read">Read more </span>
                        </div>
                      </a>
                      <div class="desc">
                        <span class="meta">{$post_date}</span>
                        <h2><a href={$post_url}>{$post_title}</a></h2>
                        <p>
                          {$post_excerpt|trim}
                        </p>
                      </div>
                    </div>
                {/if}
            {/foreach}
        </div>
        <div class="col-md-4">
            {foreach from=$posts key=id item=post}
                {if $post@iteration is div by 2 and $post@iteration is not div by 3}
                    {assign var=post_url value={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/blog/'|cat:$id}}
                    {assign var=img_url value=$post.image}
                    {assign var=post_date value=$post.date}
                    {assign var=post_title value=$post.title}
                    {assign var=post_excerpt value=$post.excerpt}
                    <div class="article animate-box fadeInUp animated">
                      <a href={$post_url} class="blog-img">
                        <img
                          class="img-fluid"
                          src={$img_url}
                          alt=""
                        />
                        <div class="overlay"></div>
                        <div class="link">
                          <span class="read">Read more </span>
                        </div>
                      </a>
                      <div class="desc">
                        <span class="meta">{$post_date}</span>
                        <h2><a href={$post_url}>{$post_title}</a></h2>
                        <p>
                          {$post_excerpt}
                        </p>
                      </div>
                    </div>
                {/if}
            {/foreach}
        </div>
        <div class="col-md-4">
            {foreach from=$posts key=id item=post}
                {if $post@iteration is not div by 2 and $post@iteration is div by 3}
                    {assign var=post_url value={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/blog/'|cat:$id}}
                    {assign var=img_url value=$post.image}
                    {assign var=post_date value=$post.date}
                    {assign var=post_title value=$post.title}
                    {assign var=post_excerpt value=$post.excerpt}
                    <div class="article animate-box fadeInUp animated">
                      <a href={$post_url} class="blog-img">
                        <img
                          class="img-fluid"
                          src={$img_url}
                          alt=""
                        />
                        <div class="overlay"></div>
                        <div class="link">
                          <span class="read">Read more </span>
                        </div>
                      </a>
                      <div class="desc">
                        <span class="meta">{$post_date}</span>
                        <h2><a href={$post_url}>{$post_title}</a></h2>
                        <p>
                          {$post_excerpt}
                        </p>
                      </div>
                    </div>
                {/if}
            {/foreach}
        </div>
    </div>
  </div>
</div>
{include file='footer.tpl'}
