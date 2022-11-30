<template>
  <div>
    <heading class="mb-6">Notification</heading>

    <div class="flex">
      <div class="w-full h-full">
        <div
          class="flex flex-row items-center justify-satrt w-full my-4 gap-x-2"
        >
          <div
            class="
              flex flex-row
              items-center
              justify-center
              cursor-pointer
              w-1/2
            "
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
            class="
              flex flex-row
              items-center
              justify-center
              cursor-pointer
              w-1/2
            "
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
        </div>
        <div
          class="
            relative
            flex flex-col
            min-w-0
            break-words
            bg-white
            w-full
            mb-6
            shadow-lg
            rounded
            p-4
          "
          v-bind:class="{
            hidden: openTab !== 1,
            block: openTab === 1,
          }"
        >
          <table class="text-center">
            <tr>
              <th style="width: 70%">المهمة</th>
              <th style="width: 20%">تم</th>
              <th>تم</th>
            </tr>
            <tr
              v-for="Notification in myNotification"
              :key="Notification.id"
              :value="Notification.id"
            >
              <td>{{ Notification.Notifications.Notifications }}</td>
              <td v-if="Notification.done">yes</td>
                <td v-else>no</td>
 <td v-if="Notification.done">   <button
                  class="
                    shadow
                    bg-gray-500

                    focus:shadow-outline focus:outline-none
                    text-white
                    font-bold
                    px-16
                    py-2
                    rounded
                  "
                  disabled
                  type="submit"

                >
                 complet
                </button></td>
                <td v-else>   <button
                  class="
                    shadow
                    bg-green-500
                    hover:bg-green-600
                    focus:shadow-outline focus:outline-none
                    text-white
                    font-bold
                    px-16
                    py-2
                    rounded
                  "
                  type="submit"
                  @click="CompletNotifications(Notification.id)"
                >
                  do
                </button></td>

            </tr>
          </table>
        </div>
        <div
          class="
            relative
            flex flex-col
            min-w-0
            break-words
            bg-white
            w-full
            mb-6
            shadow-lg
            rounded
            p-4
          "
          v-bind:class="{
            hidden: openTab !== 2,
            block: openTab === 2,
          }"
        >
          <form @submit.prevent="onSubmit" class="add-form py-4">
            <div class="md:w-1/3">
              <label
                class="
                  block
                  text-black text-base
                  ml-4
                  py-2
                  font-bold
                  md:text-right
                  mb-1
                  md:mb-0
                  pr-4
                "
              >
                المستخدم
              </label>
            </div>
            <div class="md:w-2/3">
              <select
                class="
                  select1
                  mt-1
                  block
                  w-full
                  rounded-md
                  border-2 border-balck
                  px-4
                  py-2
                  pl-3
                  pr-10
                  text-base
                  max-w-4xl
                  mx-auto
                  focus:border-black focus:outline-none focus:ring-black
                  sm:text-sm
                "
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
                class="
                  block
                  text-black text-base
                  ml-4
                  py-2
                  font-bold
                  md:text-right
                  mb-1
                  md:mb-0
                  pr-4
                "
              >
                السنة
              </label>
            </div>
            <div class="md:w-2/3">
              <textarea
                rows="6"
                cols="50"
                class="
                  bg-gray-200
                  appearance-none
                  border-2 border-gray-200
                  rounded
                  w-full
                  py-2
                  px-4
                  text-gray-700
                  leading-tight
                  focus:outline-none focus:bg-white focus:border-black
                "
                v-model="Notifications"
                id="inline-full-name"
                type="text"
              />
            </div>
            <div class="md:w-2/3">
              <button
                class="
                  shadow
                  bg-gray-500
                  hover:bg-black
                  focus:shadow-outline focus:outline-none
                  text-white
                  font-bold
                  px-16
                  py-4
                  rounded
                "
                type="submit"
                @click="sendNotifications()"
              >
                save
              </button>
            </div>
          </form>
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
      myNotificationT: [],
    };
  },
  methods: {
    getusers: function () {
      axios.post("/users").then((response) => {
        this.users = response.data;
        // console.log(this.users);
      });
    },
    myNotifications: function () {
      // alert("dbnf");
      console.log("dkdehfj");
      axios.post("/myNotification").then((response) => {
        this.myNotification = response.data;
        console.log(this.myNotifications);
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
        user: this.selected.id,
      });
    },
    toggleTabs: function (tabNumber) {
      this.openTab = tabNumber;
    },
      CompletNotifications: function ($event) {
 axios.post("/CompletNotifications", {
        Notificationsid: $event,

      });
       this.myNotifications();
},
  },

  beforeMount() {
    this.getusers();
    this.myNotifications();
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
