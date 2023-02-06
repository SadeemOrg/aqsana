<template>
  <div>
    <heading class="mb-6">Notification</heading>

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
        <div
          class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-4"
          v-bind:class="{
            hidden: openTab !== 1,
            block: openTab === 1,
          }"
        >
          <table class="text-center">
            <tr>
              <th style="width: 40%;">المهمة</th>
              <th style="width: 40%;">الملاحضات</th>

              <th style="width: 20%;">الوقت</th>

              <th>تم</th>
            </tr>
            <tr
              v-for="Notification in myNotification"
              :key="Notification.id"
              :value="Notification.id"
            >
              <td>{{ Notification.Notifications.Notifications }}</td>
              <td class="flex w-full h-full">
                <input
                  type="text"
                  id="fname"
                  class="w-full h-full"
                  v-model="Notification.note"
                />
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <svg
                  fill="#000000"
                  height="12px"
                  width="12px"
                  version="1.1"
                  id="Layer_1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  viewBox="0 0 300.003 300.003"
                  xml:space="preserve"
                  @click="AddNote(Notification.id,Notification.note)"
                >
                  <g>
                    <g>
                      <path
                        d="M150,0C67.159,0,0.001,67.159,0.001,150c0,82.838,67.157,150.003,149.997,150.003S300.002,232.838,300.002,150
			C300.002,67.159,232.839,0,150,0z M213.281,166.501h-48.27v50.469c-0.003,8.463-6.863,15.323-15.328,15.323
			c-8.468,0-15.328-6.86-15.328-15.328v-50.464H87.37c-8.466-0.003-15.323-6.863-15.328-15.328c0-8.463,6.863-15.326,15.328-15.328
			l46.984,0.003V91.057c0-8.466,6.863-15.328,15.326-15.328c8.468,0,15.331,6.863,15.328,15.328l0.003,44.787l48.265,0.005
			c8.466-0.005,15.331,6.86,15.328,15.328C228.607,159.643,221.742,166.501,213.281,166.501z"
                      />
                    </g>
                  </g>
                </svg>
              </td>
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
                  complet
                </button>
              </td>
              <td v-else>
                <button
                  class="shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-2 rounded"
                  type="submit"
                  @click="CompletNotifications(Notification.id)"
                >
                  do
                </button>
              </td>
            </tr>
          </table>
        </div>
        <div
          class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-4"
          v-bind:class="{
            hidden: openTab !== 2,
            block: openTab === 2,
          }"
        >
          <form @submit.prevent="onSubmit" class="add-form py-4">
            <div class="md:w-1/3">
              <label
                class="block text-black text-base ml-4 py-2 font-bold md:text-right mb-1 md:mb-0 pr-4"
              >
                المستخدم
              </label>
            </div>
            <div class="md:w-2/3">
              <select
                class="select1 mt-1 block w-full rounded-md border-2 border-balck px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm"
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
            <div class="md:w-1/3">
              <label
                class="block text-black text-base ml-4 py-2 font-bold md:text-right mb-1 md:mb-0 pr-4"
              >
                التاريج
              </label>
            </div>
            <div class="md:w-2/3">
              <input
                type="date"
                v-model="date"
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
              />
            </div>
            <div class="md:w-1/3">
              <label
                class="block text-black text-base ml-4 py-2 font-bold md:text-right mb-1 md:mb-0 pr-4"
              >
                المهمة
              </label>
            </div>
            <div class="md:w-2/3">
              <textarea
                rows="6"
                cols="50"
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                v-model="Notifications"
                id="inline-full-name"
                type="text"
              />
            </div>
            <div class="md:w-2/3">
              <button
                class="shadow bg-gray-500 hover:bg-black focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
                type="submit"
                @click="sendNotifications()"
              >
                save
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
              class="block text-black text-base ml-4 py-2 font-bold md:text-right mb-1 md:mb-0 pr-4"
            >
              المستخدم
            </label>
          </div>
          <div class="md:w-2/3">
            <select
              @change="AdminNotifications($event)"
              class="select1 mt-1 block w-full rounded-md border-2 border-balck px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm"
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

              <th style="width: 20%;">الوقت</th>

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
                complet
              </td>
              <td v-else>
                not complet
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

        console.log(this.myNotification[0].Notifications.Notifications);
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

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
