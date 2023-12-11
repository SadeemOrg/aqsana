<template>
  <div>
    <heading class="mb-6">المهام و الاشعارات</heading>

    <div class="flex">
      <div class="w-full h-full">
        <div
          class="flex flex-row items-center justify-satrt w-full my-4 gap-x-2"
        >
          <div
            class="flex flex-row items-center justify-center cursor-pointer w-1/2"
          >
            <a
              v-on:click="toggleTabs(1)"
              v-bind:class="{
                'text-green-600 bg-white w-full py-4 text-center rounded-md':
                  openTab !== 1,
                'text-white  bg-green-600 w-full py-4 text-center rounded-md':
                  openTab === 1,
              }"
            >
              مهامي
            </a>
          </div>
          <div
            class="flex flex-row items-center justify-center cursor-pointer w-1/2"
          >
            <a
              class=""
              v-on:click="toggleTabs(2)"
              v-bind:class="{
                'text-green-600 bg-white w-full py-4 text-center rounded-md':
                  openTab !== 2,
                'text-white  bg-green-600 w-full py-4 text-center rounded-md':
                  openTab === 2,
              }"
            >
              اضافة مهام
            </a>
          </div>
          <div

            class="flex flex-row items-center justify-center cursor-pointer w-1/2"
          >
            <a
              class=""
              v-on:click="toggleTabs(3)"
              v-bind:class="{
                'text-green-600 bg-white w-full py-4 text-center rounded-md':
                  openTab !== 3,
                'text-white  bg-green-600 w-full py-4 text-center rounded-md':
                  openTab === 3,
              }"
            >
              مهام الموظفين
            </a>
          </div>
        </div>
        <div class="overflow-x-auto ">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-4 for-mobile-scoll-x"
            v-bind:class="{
              hidden: openTab !== 1,
              block: openTab === 1,
            }"
          >

            <table class="text-center">
              <tr>
                <th style="width: 40%;">المهمة</th>
                <th style="width: 40%;">الملاحضات</th>
                <th style="width: 10%;">المرسل   </th>

                <th style="width: 10%;">التاريخ</th>

                <th>تم</th>
                <th>حذف</th>

              </tr>
              <tr
                v-for="Notification in myNotification"
                :key="Notification.id"
                :value="Notification.id"
              >
                <td>{{ Notification.Notifications.Notifications }}</td>
                <td class="flex w-full h-full">
                  <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                  <div class="relative w-full">
                      <!-- <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      </div> -->
                      <input type="text"  id="fname" v-model="Notification.note" class="block w-full p-4  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                      <button  @click="AddNote(Notification.id,Notification.note)" type="submit" class="text-white absolute  left-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">اضافة</button>
                  </div>
                </td>
                <td >  {{ Notification.sender.name  }}</td>
                <td v-if="Notification.Notifications.date">
                  {{ Notification.Notifications.date }}
                </td>
                <td v-else>no Time</td>

                <td v-if="Notification.done">
                  <button
                    class="shadow bg-gray-500 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-2 rounded"
                    @click="UNCompletNotifications(Notification.id)"
                    type="submit"
                  >
                    مكتمل
                  </button>
                </td>
                <td v-else>
                  <button
                    class="shadow bg-green-500 hover:bg-green-600 text-sm focus:shadow-outline focus:outline-none text-white px-10 py-2 rounded"
                    type="submit"
                    @click="CompletNotifications(Notification.id)"
                  >
                    تم
                  </button>
                </td>
                <th>  <button
                    class="shadow bg-red-500 hover:bg-red-600 text-sm focus:shadow-outline focus:outline-none text-white px-10 py-2 rounded"
                    type="submit"
                    @click="DeleteNotifications(Notification.id)"
                  >
                    حذف
                  </button></th>

              </tr>
            </table>
          </div>
        </div>
        <div
          class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-4"
          v-bind:class="{
            hidden: openTab !== 2,
            block: openTab === 2,
          }"
        >
          <form @submit.prevent="onSubmit" class="add-form py-4">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-4">
              <div>
                <label
                class="block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0"
              >
                المستخدم
              </label>
              <select
                class="select1 mt-1 block w-full rounded-md border border-gray-200 px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm"
                v-model="selected"
                >
                  <option selected disabled value="0">Please select one</option>

                  <option
                    v-for="user in users"
                    :key="user.id"
                    v-bind:value="{ id: user.id }"
                  >
                    {{ user.name }}
                  </option>
                </select>

              </div>
              <div>
                <label
                class="block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0"
                >
                  التاريج
                </label>
                <div>
                  <input
                    type="date"
                    v-model="date"
                    class=" appearance-none border border-gray-200 rounded w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                  />
                </div>
              </div>
            </div>

            <div class="md:w-1/3">
              <label
                class="block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0"
              >
                المهمة
              </label>
            </div>
            <div class="md:w-2/3">
              <textarea
                rows="6"
                cols="50"
                class=" appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                v-model="Notifications"
                id="inline-full-name"
                type="text"
              />
            </div>
            <div class="md:w-2/3">
              <button
                class="shadow bg-green-600 hover:bg-green-500 mt-4 focus:shadow-outline focus:outline-none text-white font-medium px-16 py-4 rounded"
                type="submit"
                @click="sendNotifications()"
              >
                حفظ
              </button>
            </div>
          </form>
        </div>
        <div
          class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-4"
          v-bind:class="{
            hidden: openTab !== 3,
            block: openTab === 3,
          }"
        >
          <div class="md:w-1/3">
            <label
              class="block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0"
            >
              المستخدم
            </label>
          </div>
          <div class="md:w-2/3 mb-8">
            <select
              @change="AdminNotifications($event)"
              class="select1 mt-1 block w-full rounded-md border border-gray-200 px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm"
              v-model="selectedAdmin"
            >
              <option selected disabled value="0">Please select one</option>

              <option v-for="user in users" :key="user.id" :value="user.id">
                {{ user.name }}
              </option>
            </select>
          </div>

          <table class="text-center">
            <tr>
              <th style="width: 40%;">المهمة</th>
              <th style="width: 40%;">الملاحضات</th>

              <th style="width: 20%;">التاريخ</th>

              <th>تم</th>
            </tr>
            <tr
              v-for="Notification in allNotifications"
              :key="Notification.id"
              :value="Notification.id"
            >
              <td>{{ Notification.Notifications.Notifications }}</td>
              <td>{{ Notification.note }}</td>

              <td v-if="Notification.Notifications.date">
                {{ Notification.Notifications.date }}
              </td>
              <td v-else>no Time</td>

              <td v-if="Notification.done">
                مكتمل
              </td>
              <td v-else>
              تم
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      myNotification: [],
      openTab: 1,
      Admin: 1,
      myNotificationT: [],
      allNotifications: [],
    };
  },
  methods: {
    getusers: function () {
      axios.post("/users").then((response) => {
        this.users = response.data;
        // console.log("user admin", this.users);
      });
    },
    UserAdmin: function () {
      axios.post("/UserAdmin").then((response) => {
        console.log("start");
        console.log(this.Admin);
        this.Admin = response.data;

        console.log("user admin");
        console.log(this.Admin);
        console.log("finsh");
      });
    },
    myNotifications: function () {
      // alert("dbnf");
      console.log("dkdehfj");
      axios.post("/myNotification").then((response) => {
        this.myNotification = response.data;
        console.log("**********************************");

        console.log(this.myNotification[0]);
        console.log("**********************************");

        // console.log(this.myNotification[0]);
        // console.log(( this.myNotification[0].Notifications.Notifications));
        //   console.log(( this.myNotification[0].done));
        //             console.log(( this.myNotification[0].id));

        // this.myNotificationT = JSON.parse( this.myNotification[0].data);
        // console.log( this.myNotificationT);
        // console.log( this.myNotificationT['Notifications']);
        // console.log( this.myNotificationT['Notifications'].body);

        console.log("dkdehfj");
      });
    },
    sendNotifications() {
      axios.post("/sendNotification", {
        Notifications: this.Notifications,
        date: this.date,
        user: this.selected.id,
      });
      this.myNotifications();
      this.Notifications = [];
      this.selected.id = 0;
      alert("send done");
    },

    AdminNotifications(event) {
      // alert(event.target.value);
      axios
        .post("/AdminNotifications", {
          user: event.target.value,
        })
        .then((response) => {
          this.allNotifications = response.data;
        });
        console.log( this.allNotifications);
    },
    toggleTabs: function (tabNumber) {
      this.openTab = tabNumber;
    },
    UNCompletNotifications: function ($event) {
      axios.post("/UNCompletNotifications", {
        Notificationsid: $event,
      });
      this.myNotifications();
    },
    CompletNotifications: function ($event) {
      axios.post("/CompletNotifications", {
        Notificationsid: $event,
      });
      this.myNotifications();
    },
    DeleteNotifications: function ($event) {
      axios.post("/DeleteNotifications", {
        Notificationsid: $event,
      });
      this.myNotifications();
    },
    AddNote: function ($event,$note) {
        // alert($note);
        if ($note) {
                axios.post("/AddNoteNotifications", {
        Notificationsid: $event,
        NotificationsNote: $note,

      })  .then((response) => {
        alert("done");
        });
      this.myNotifications();
        }


    },
  },

  beforeMount() {
    this.getusers();
    this.myNotifications();
    this.UserAdmin();
  },
};
</script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td,
th {
  border: 1px solid #dddddd;

  padding: 8px;
}

.for-mobile-scoll-x {
  min-width: 800px;
}
</style>
