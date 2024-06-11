<template>
  <card>
    <div class="px-3 py-3">
      <h1 class="text-center text-3xl text-80 font-light">جدول فواتير :</h1>
      <table class="text-center w-full">
        <tr>
          <th style="width: 25%">تاريخ</th>
          <th style="width: 25%">مدخلات</th>
          <th style="width: 25%">مخرجات</th>
          <th style="width: 25%">صافي الانفاق</th>
        </tr>

        <tr
          v-for="schedule in schedules"
          :key="schedule.id"
          :value="schedule.id"
        >
          <td>{{ schedule.year }}/{{ schedule.month }}</td>
          <td>{{ schedule.Transactions.toFixed(2) }}</td>
          <td>{{ schedule.spendingTransactions.toFixed(2) }}</td>
          <td>{{ (schedule.Transactions - schedule.spendingTransactions).toFixed(2) }}</td>
        </tr>
        <tr
        >
          <td>المجموع</td>
          <td>{{ totalinput.toFixed(2) }}</td>
          <td>{{ totaloutput.toFixed(2) }}</td>
          <td>{{ (totalinput - totaloutput).toFixed(2) }}</td>
        </tr>
      </table>
    </div>
  </card>
</template>

<script>
export default {
  data() {
    return {
      schedules: [],
      totalinput:0,
      totaloutput:0,

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
    schedulelast: function () {
      axios.post("/schedulelast").then((response) => {
        console.log("start");
        this.schedules = response.data;
        console.log(this.schedules);

        console.log("f");
      this.Sumschedulelast();
      });
    },
    Sumschedulelast: function () {
        let sumsArray = {};

       this.schedules.forEach(item => {
this.totalinput +=item.Transactions
this.totaloutput+=item.spendingTransactions
// console.log(item.Transactions);
// console.log(item.spendingTransactions);
       });
          console.log(this.totalinput);
        console.log(this.totaloutput);
    },
  },
  beforeMount() {
    this.schedulelast();
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
