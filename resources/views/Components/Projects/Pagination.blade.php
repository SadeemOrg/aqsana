{{-- <div class="flex justify-center mt-16">
    <nav aria-label="Page navigation example">
        <ul class="flex list-style-none gap-x-1">
            <li class="page-item">
                <a class="page-link relative block py-1 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-[#349A37] focus:shadow-none"
                    href="#">1</a>
            </li>
            <li class="page-item active">
                <a class="page-link relative block py-1 px-3 border-0 bg-[#101426]  outline-none transition-all duration-300 rounded-full text-white hover:text-white hover:bg-[#349A37] shadow-md focus:shadow-md"
                    href="#">2 </a>
            </li>
            <li class="page-item">
                <a class="page-link relative block py-1 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-[#349A37] focus:shadow-none"
                    href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link relative block py-1 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-[#349A37] focus:shadow-none"
                    href="#">4</a>
            </li>
        </ul>
    </nav>
</div> --}}

        <!-- Pagination-->
        {{-- <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#"><i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'right ml-2 pb-2' : 'left mr-2 pb-2'}}"></i>{{\App\CPU\translate('Prev')}}</a></li>
            </ul>
            <ul class="pagination">
                <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
                <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="sr-only">({{\App\CPU\translate('current')}})</span></span></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">2</a></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
            </ul>
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#" aria-label="Next">{{\App\CPU\translate('Next')}}<i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-2 mb-4' : 'right ml-2 mb-4'}}"></i></a></li>
            </ul>
        </nav>

<div class="mb-16 ">
    <div class="container max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 ">
      <nav class="flex justify-center pt-2" aria-label="Page navigation"
          id="paginator-ajax">
          {!! $News->links() !!}
      </nav>
    </div>
  </div> --}}

  {{-- {{ $items->links() }} --}}
  {{ $news->links() }}
