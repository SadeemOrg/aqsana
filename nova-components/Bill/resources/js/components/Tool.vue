<template>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-14 px-2">
    <div class="flex flex-col items-center justify-center mt-40 max-w-4xl mx-auto">
        <img
            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAEjklEQVRoge3ZW4hWVRQH8J+SU+oUlnT3ocSKtHooqCiKJGoqM7IMIywKpEi7QNFFjTKLsgIfQkkfgsgiEp+6UVjZzUylmykFaUWEdsNuVl7GmR7WPp0zZ765fF/fNzOGf9jMnLXX2nv9z9lr77XXx178fzEZn2InVmFK/7pTGy7FbrQXWhum9adTtWCNcH4OmnFnet6BM/vRr6rxu3C8uSB7PMm2YFR/OFULPhJOzyjI9sHrSb4WQyvYTRBf84/096LGutkzLlN5KR2EjalvSclmgo4xlbWGk5mA1diKd3EtBhf6F6i8lMbht9R3e0G+NsnuwnDcnZ5XN8b9wAVo1fntfSYIwhC8qfJSmih2tVa0JNmOpNuUnpvS8/ZGkYD30iSzMAxXypdMO97CqRiJTSovpeyN/yRIZ7ZFVJLVFVvTBMMLsibcjB/l58ZSES/ZLlZcSoOwIcnP6MLphhP5IE0wMzlUxAF4ANuSzk58lf5vxWkF3SyOZnXhdMOJXCiPkTUYX0HncCzGLh3jaH5BZ3KSvaafiBAB/21hsldwUgW9E+RLsR0fF/oOEUtwm34kQsTFrfglTbhbxMXokl52rmQ6Iwt9G3T8YkX0GZEMI8WS2Z4m/hv3l3QWFRybVJAvNICIZDgaz4rl0o7rC31DsT7JHy3IrzAAiWSYmhz4S5zkGcbiHVxckB0qJz7giMCTyYn14tDsDssNICJnYYWIj3LqMq8H2xEinXmxJO9zIlN1Pi+Ku9TsGsftUyLXya+183BgHcfuMyLT5CRqfevdoU+I3CjfbW5r0BwNJ3KLINEmTvYiWvAcHhKxc4qOWXI12CyIPFyjfbdokZO4qdR3uch2ywHfhm/wqriHlDPmrnC+PFuY+V8dL2NVGviOknyKfOdahLl4Hp8UnMnaxCrmm1QYd0YPulUhy2RHFGRT5Wn93Ao2g0Ui+VjSWVXlnFeLTWU3rqnStktkX2Q29hfxku1c9/Zg24yfk+65Vc47Pdnt0jHprBlZjJTjoLfb7z1J/40a5i7e8/8zjhElmjKRD3F2L+xH4Ndkc3oN89dtS/6hMNiX4pq6RX4/b+na9F88mPTLuVVvUDciL6eBnirI9sUTSb5Fz2nKePm2XG1KUzciJycH/hQFhgyDRcWxXRQdusKx+D7pLath/rqe9svSYAtK8uNEGt+mcmVlFL5OtsvFl6wWdSUyVpwbO3BUqW9OmmgrXsB9oow6Dl+kvrf1fNnqCnXPv57WOVaIt/y+zrta1taIIl6tqDuR0WKXasXxFfqPxCWimvISvsNKHUtBtaAhGXFW4lla74G7QUOIHCEqJW2i+t4XaNgdZX4aeIXIvRqNhhE5WJ5ybBaZam/vG7WgobfGE0XhLZtkpTg4K2EIzsEjyWajOHt2ifTnc3HDvEEcnmU0/Po7CFeJ3SkrAy0WZ84wkSAulBe8e9vWicx6TF8RydAsykLZb4KV2npR/z1PvPVhorJ/mPhpYrq4XZZJr9WHRDKMEYnkJnHKrxPLaVx3RiU0iWvxEvkvwdnX3mOxn7gZPiMqNHuxR+EfPy/DQuFyLnAAAAAASUVORK5CYII=" />
        <h2 v-if="type === '1'" class="mt-2 font-FlatBold text-center text-2xl lg:text-3xl">
            يوفي! سند القبض رقم F-1000 {{ id }} تم انتاجة بنجاح
        </h2>
        <h2 v-else class="mt-2 font-FlatBold text-center text-2xl lg:text-3xl">
            يوفي! فاتورة رقم F-1000{{ id }} تم انتاجة بنجاح
        </h2>
        <h3 class="mt-4 font-FlatBold text-center text-lg lg:text-xl">
            تم ارسال الملف للايمال الحاص بك, وتم ارسال ايميل للشخص المتبرع في حالو
            وجود ايميل خاص به <br>,ايضا نسخة عن الملف تم حفظه في المنظومه
        </h3>
        <div class="flex md:flex-row flex-col items-center justify-between md:gap-y-0 gap-y-3  w-full mt-12">

            <div
                class=" relative flex flex-col items-center justify-center max-h-14 pt-16  pl-2 basis-2/6   md:border-b-0 py-4 min-w-[260px] md:min-w-0  md:border-l-2 min-h-[145px]  border-gray-500  gap-y-3">
                <img src="/assets/image/paper-plane.png" class="w-8 h-8 absolute right-3 top-[45px]" alt="">
                <h3 class="font-FlatBold text-center text-lg lg:text-xl">تم ارسال الملف للايمال التالي</h3>
                <h3 class="font-FlatBold text-center text-base lg:text-lg">alqudsquds@gmail.com</h3>
                <div class="flex md:flex-row flex-col items-center justify-between  w-full mt-2">
                    <form  @submit.prevent="onSubmit" method="get">
                        <input type="search" name="id" id="search" autocomplete="off"
                            class="hidden search-bar h-16 sm:h-full  pr-12 sm:pr-20 shadow-sm  w-full bg-white border-2 sm:text-sm rounded-md focus:ring-[#349A37] focus:border-[#349A37]">
                        <input type="search" v-model='mail' name="Mail" id="search" autocomplete="off"
                            placeholder="الرجاء ادخال الايميل "
                            class=" h-16 sm:h-full  pr-12 sm:pr-4 shadow-sm  block w-[85%] bg-white border-2 sm:text-sm rounded-md focus:ring-[#349A37] focus:border-[#349A37]">
                        <div class="flex flex-row items-center justify-center w-full">
                            <button type="submit"   @click="send($event)"
                                class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                                ارسال
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <a :href="`/originalbill/${id}`"
                class="flex flex-col justify-center cursor-pointer items-center  md:border-b-0 py-4 min-w-[260px] md:min-w-0  md:border-l-2 pl-2 basis-1/5 min-h-[145px] border-gray-500 gap-y-3">
                <img src="/assets/image/pdf.png" class="w-8 h-8 " alt="">
                <h3 class="font-FlatBold text-center text-lg lg:text-xl">نسخة أصلية</h3>
            </a>
            <a :href="`/bill/${id}`"
                class="flex flex-col justify-center cursor-pointer items-center  md:border-b-0 py-4 min-w-[260px] md:min-w-0  md:border-l-2 pl-2 basis-1/5 min-h-[145px] border-gray-500 gap-y-3">
                <img src="/assets/image/pdf.png" class="w-8 h-8 " alt="">
                <h3 class="font-FlatBold text-center text-lg lg:text-xl">نسخة عن الأصلية</h3>
            </a>
            <a :href="`https://api.whatsapp.com/send?text=${baseUrl}/generate-pdf/${id}`"
                class="flex flex-col justify-center cursor-pointer items-center  md:border-b-0 py-4 min-w-[260px] md:min-w-0  md:border-l-2 pl-2 basis-1/5 min-h-[145px] border-gray-500 gap-y-3">
                <img src="/assets/image/whatsappbill.png" class="w-8 h-8 " alt="">
                <h3 class="font-FlatBold text-center text-lg lg:text-xl">ارسال عن طريق الواتس اب</h3>
            </a>

        </div>



    </div>
</div>
</template>

<script>
import { useRoute } from "vue-router";

export default {
  data() {
    return {
      id: "",
      type: "",
      mail: "",
      userFilter: "",
      typeFilter: "",
      baseUrl: "",
    };
  },
  setup() {
    const route = useRoute();

    onMounted(() => {
      this.id = route;
    });
  },
  data() {
    return {
      info: null,
    };
  },

  methods: {
    getImage() {
      return "/assets/image/pdf.png";
    },
    originalbill: function () {
      var baseUrl = window.location.origin;
      alert(baseUrl);

      window.location.href = "http://siwei.me";
    },
    send(event) {
      axios.post("/SendMail", {
        Mail: this.mail,
        id: this.id,
      });
    },
    getYears: function () {
      let queryString = window.location.search;
      let urlParams = new URLSearchParams(queryString);
      console.log("urlParams", urlParams);
      this.id = urlParams.get("location");
      this.type = urlParams.get("type");
      this.baseUrl = window.location.origin;
      // alert(this.type);
      console.log("  locationFilter", this.id);
    },
  },
  beforeMount() {
    this.getYears();
  },
};
</script>

<style>
/* Scoped Styles */
</style>
