<template>
  <card class="flex flex-col">
    <form @submit.prevent="onSubmit" method="get">
      <div class="mb-6 p-12">
        <label
          for="default-input"
          class="block mb-2 text-xl font-medium text-gray-900 dark:text-white"
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
          class="block mb-2 text-xl font-medium text-gray-900 dark:text-white"
          >ادخل نص الرسالة
        </label>
        <input
          v-model="Message"
          type="text"
          id="default-input"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        />
        <div class="flex flex-row items-center justify-end mt-4">
          <button
            type="submit"
            @click="send"
            class="shadow bg-gray-500 hover:bg-black focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
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
  },
};
</script>
