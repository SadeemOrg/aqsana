<template>
  <card class="flex flex-col">
    <form @submit.prevent="onSubmit" method="get">
      <div class="mb-6 p-12">
        <label
          for="default-input"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >اختر الفئة
        </label>
        <select
          class="w-full form-control form-input form-input-bordered mb-4 "
          name="LeaveTypde"
          v-model="selectval"
        >
          <option value="1">متبرعين سجب ثابت </option>
          <option value="2"> متبرعين لمرة واحدة</option>
          <option value="3">مندوبين </option>
          <option value="4">متطوعين </option>
          <option value="5">جهات اتصال عامة </option>
          <option value="6"> مرشدين</option>
          <option value="7"> منح</option>
          <option value="8">شركات</option>
          <option value="9"> Sms</option>
          <option value="10"> Test</option>
        </select>
        <label
          for="default-input"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >ادخل نص الرسالة
        </label>
        <span>Add a comment</span> <em class="text-light">(up to a 140 characters)</em>
        <textarea  v-on:keyup="countdown" v-model="message" placeholder="" id="default-input"  name="" cols="30" rows="10" class="appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"></textarea>
        <p class='text-right text-small' v-bind:class="{'text-danger': hasError }">{{remainingCount}}</p>
        <div class="flex flex-row items-center justify-end mt-4">
          <button
            type="submit"
            @click="send"
            class="shadow bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
          >
            ارسال
          </button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
export default {
  data() {
    return {
      Message: "",
      selectval:[],
      maxCount: 140,
    remainingCount: 140,
    message: '',
    hasError: false
    };
  },
  props: [
    "card",

    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  methods: {
      send() {

      axios
        .post("/SendMessage", {
          type: this.selectval,
          Message: this.Message,
        })
        .then((response) => {
          alert("Message Send ");
        });
    },
    countdown: function() {
      this.remainingCount = this.maxCount - this.message.length;
      this.hasError = this.remainingCount < 0;
    }
  },
};
</script>
