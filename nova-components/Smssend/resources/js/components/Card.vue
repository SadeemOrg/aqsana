<template>
  <card class="flex flex-col">
    <form @submit.prevent="onSubmit" method="get">
      <div class="mb-6 p-12">
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
      alert(this.Message);
      axios
        .post("/SendMessage", {
            Message:this.Message
        })
        .then((response) => {
       alert('Message Send ')
        });
    },
  },
};
</script>
