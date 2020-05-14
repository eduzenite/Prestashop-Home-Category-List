{if isset($categories) && $categories}
    <hr>
    <div class="clearfix"></div>
    <h2 class="display-1" style="text-align: center">Categorias</h2>
    <p style="text-align: center">Modelos de PowerPoint editáveis.</p>
    <div class="row">
        {foreach from=$categories[2]['children'] item=mainCategory}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href="/{$mainCategory['id_category']}-{$mainCategory['link_rewrite']}">
                            <img class="img-fluid card-img-top"
                                 src="/img/tmp/category_{$mainCategory['id_category']}.jpg?v=3"
                                 alt="{$mainCategory['name']}"/>
                        </a>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
{/if}
