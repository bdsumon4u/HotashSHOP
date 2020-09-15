const client = algoliasearch("Z8I9YR2F4F", "c386f96a5ff819e9a791a018bc484f9d");
const products = client.initIndex("products");

let enterPressed = false;

autocomplete(".aa-input-search", {}, [
    {
        source: autocomplete.sources.hits(products, { hitsPerPage: 5 }),
        displayKey: "name",
        templates: {
            header: '<div class="aa-suggestions-category">Products</div>',
            suggestion({
                base_image,
                slug,
                should_track,
                stock_count,
                _highlightResult
            }) {
                return `<div class="product-suggestion d-flex">
                <div class="product-image">
                    <a href="${window.location.origin +
                        "/products/" +
                        slug}"><img src="${base_image}" alt="" width="80" height="80"></a>
                </div>
                <div class="product-name"><a href="${window.location.origin +
                    "/products/" +
                    slug}">${_highlightResult.name.value}</a></div>
                <div class="product-meta ml-auto d-flex flex-column">
                    <div class="product-actions mr-auto" style="width: 110px;">
                        <div class="product-availability" style="white-space: nowrap;">Availability:
                            ${
                                should_track
                                    ? stock_count
                                        ? '<span class="text-success">YES [' +
                                          stock_count +
                                          "]</span>"
                                        : '<span class="text-danger">NO</span>'
                                    : '<span class="text-success">YES</span>'
                            }
                        </div>
                        <div class="product-card__prices">
                            <span class="product-card__new-price">$949.00</span>
                            <span class="product-card__old-price">$1189.00</span>
                        </div>
                    </div>
                </div>
            </div>`;
            },
            empty(result) {
                return `<div class="p-2">No Result Found.</div>`;
            }
        }
    }
]).on('autocomplete:selected', function (event, {slug}, dataset) {
    window.location = window.location.origin + '/products/' + slug;
    enterPressed = true;
})
.on('keyup', function (event) {
    if (event.keyCode == 13 && !enterPressed) {
        window.location = window.location.origin + '/products?search=' + this.value;
    }
});
