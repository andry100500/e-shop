<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "{{ $product->productDescription->name }}",
  "image": "---ImageURL---",
  "description": "---Description---",
  "brand": {
    "@type": "Brand",
    "name": "---Brand---"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "UAH",
    "price": "100",
    "url": "https://url",
    "availability": "https://schema.org/InStock",  {{-- TODO--}}
    "itemCondition": "https://schema.org/NewCondition"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue" : "4.5",
    "ratingCount" : "45",
    "reviewCount" : "1",
    "worstRating" : "1",
    "bestRating" : "5"
  },



  "review": [
    {
      "@type": "Review",
      "name" : "title",
      "author": {
        "@type": "Person",
        "name": "----author name---"
      },
      "datePublished": "2022-01-12",
      "reviewBody" : "REVIEW BODY",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue" : "4.5",
        "worstRating" : "1",
        "bestRating" : "5"
      }
    },







      @if(count($product->reviews) > 0)


        {
"@type": "Review",
"name" : "title 2",
"author": {
  "@type": "Person",
  "name": "author 2"
},
"datePublished": "2022-01-20",
"reviewBody" : "review Body",
"reviewRating": {
  "@type": "Rating",
  "ratingValue" : "4.7",
  "worstRating" : "1",
  "bestRating" : "5"
}

@foreach($product->reviews as $review)

            {{ $review->name }}

            {{ $review->text }}
            @if($review->pluses)

                {{ $review->pluses }}

            @endif

            @if($review->minuses)

                {{ $review->minuses }}

            @endif



        @endforeach

    @endif


    }
  ]
}


</script>


