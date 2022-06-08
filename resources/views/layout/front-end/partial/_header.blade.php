<style>
    .McButton {
        position: absolute;
        top: 50%;
        right: 4%;
        margin-left: -22px;
        margin-top: -22px;
        width: 35px;
        height: 20px;
        cursor: pointer;
    }

    .McButton b {
        position: absolute;
        left: 0;
        width: 36px;
        height: 3px;
        background-color: black;
    }

    .McButton b:nth-child(1) {
        top: 0;
    }

    .McButton b:nth-child(2) {
        top: 50%;
    }

    .McButton b:nth-child(3) {
        top: 100%;
    }

    /* McButton */
    /* End navbtn style */
</style>

<div dir="rtl" class="flex flex-row justify-between items-center my-4 h-14  w-full pr-20 pl-24 relative">

    <ul class="hidden xl:flex basis-2/5 flex-row justify-between items-center text-base text-[#101426] font-FlatBold cursor-pointer nav">
       <li> <a class="hover:text-[#349A37]" href="/aboutus">من نحن</a></li>
       <li> <a class="hover:text-[#349A37]" href="/our-project">مشاريعنا</a></li>
        <li> <a class="hover:text-[#349A37]" href="#">اخبارنا</a></li>
            <li> <a class="hover:text-[#349A37]" href="#">القدس والمسجد الاقصى</a></li>
    </ul>
    <img class="hidden xl:flex basis-2/5 max-w-[200px] max-h-[60px]" src="{{ asset('assets/image/image 1.svg') }}" />
    <div
        class="hidden xl:flex flex-row  basis-2/5 justify-between items-center text-base text-[#101426] cursor-pointer">
        <a class="hover:text-[#349A37]" href="#">الاوقاف والمقدسات</a>
        <a class="hover:text-[#349A37]" href="#">حصاد الجمعية</a>
        <a class="hover:text-[#349A37]" href="#"> التبرع للمشاريع</a>
        <a class="hover:text-[#349A37]" href="#">اتصل بنا</a>
    </div>
    <div class="mt-5 ml-3 block xl:hidden">
        <a class="McButton nav-btn w-[40px] relative block" data="hamburger-menu">
            <b></b>
            <b></b>
            <b></b>
        </a>
    </div>
    <img class="flex xl:hidden max-w-[200px] max-h-[60px]" src="{{ asset('assets/image/image 1.svg') }}" />
</div>
