<template>
  <div>
    <div class="flex">
      <div class="w-full">
        <div
          class="flex flex-row items-center justify-satrt w-full my-4 gap-x-2"
        >
          <div
            class="flex flex-row items-center justify-center cursor-pointer w-1/4"
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
              الميزانيات
            </a>
          </div>
          <div
            class="flex flex-row items-center justify-center cursor-pointer w-1/4"
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
              اضافة جدييد
            </a>
          </div>
          <div
            class="flex flex-row items-center justify-center cursor-pointer w-1/4"
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
              حذف
            </a>
          </div>
          <div
            class="flex flex-row items-center justify-center cursor-pointer w-1/4"
          >
            <a
              class="w-full"
              v-on:click="toggleTabs(4)"
              v-bind:class="{
                'text-green-600 bg-white w-full py-4 text-center rounded-md':
                  openTab !== 4,
                'text-white  bg-green-600 w-full py-4 text-center rounded-md':
                  openTab === 4,
              }"
            >
              احصائبات
            </a>
          </div>
        </div>
        <div
          class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
        >
          <div class="px-4 py-5 flex-auto">
            <div class="tab-content tab-space">
              <!-- first from -->
              <div
                v-bind:class="{
                  hidden: openTab !== 1,
                  block: openTab === 1,
                }"
              >
                <div class="py-4 w-[95%] bg-slate-700">
                  <div class="md:w-1/3">
                    <label
                      class="block text-black text-base ml-4 py-2 font-bold md:text-right mb-1 md:mb-0 pr-4"
                    >
                      السنة
                    </label>
                  </div>
                  <select
                    class="select1 mt-1 block w-full rounded-md border-2 border-balck px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm"
                    @change="onChange($event)"
                    v-model="year"
                  >
                    <option selected disabled value="0">
                      Please select one
                    </option>

                    <option
                      v-for="year in years"
                      :key="year.year"
                      :value="year.year"
                    >
                      {{ year.year }}
                    </option>
                  </select>
                </div>
                <form @submit.prevent="onSubmit" class="add-form py-4">
                    <!-- <div

                    class="md:flex md:items-center mb-6"
                  >
                    <div class="md:w-1/3">
                      <label
                        class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4 text-lg w-64"
                        for="inline-full-name"
                      >
                        {{ Sector.Sector }}
                      </label>
                    </div>
                    <div class="md:w-2/3">
                      <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                        id="inline-full-name"
                        type="text"
                        v-model="Sector.Budget"
                      />
                    </div>
                  </div> -->
                  <div
                    v-for="Sector in Sectors"
                    :key="Sector.Sector"
                    :value="Sector.Sector"
                    class="md:flex md:items-center mb-6"
                  >
                    <div class="md:w-1/3">
                      <label
                        class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4 text-lg w-64"
                        for="inline-full-name"
                      >
                        {{ Sector.Sector }}
                      </label>
                    </div>
                    <div class="md:w-2/3">
                      <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                        id="inline-full-name"
                        type="text"
                        v-model="Sector.Budget"
                      />
                    </div>
                  </div>

                  <div
                    v-if="Sectors.length"
                    class="md:flex md:items-center w-11/12 justify-end"
                  >
                    <div class="md:w-2/3">
                      <button
                        class="shadow bg-gray-500 hover:bg-black focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
                        type="submit"
                        @click="save()"
                      >
                        حفظ
                      </button>
                    </div>
                  </div>
                </form>
              </div>

              <div
                v-bind:class="{
                  hidden: openTab !== 2,
                  block: openTab === 2,
                }"
              >
                <div class="md:w-1/3">
                  <label
                    class="block text-black text-base ml-4 py-2 font-bold md:text-right mb-1 md:mb-0 pr-4"
                  >
                    السنة
                  </label>
                </div>
                <div class="md:w-2/3">
                  <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                    id="inline-full-name"
                    type="text"
                    v-model="newyear"
                  />
                </div>
                <div class="md:w-1/3">
                  <label
                    class="block text-black text-base ml-4 py-2 font-bold md:text-right mb-1 md:mb-0 pr-4"
                  >
                    ميزانبة السنة
                  </label>
                </div>
                <div class="md:w-2/3">
                  <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                    id="inline-full-name"
                    type="text"
                    v-model="budgetsOfyear"
                  />
                </div>
                <form @submit.prevent="onSubmit" class="add-form py-4">
                  <div
                    v-for="Sector in newSectors"
                    :key="Sector.Sector"
                    :value="Sector.Sector"
                    class="md:flex md:items-center mb-6"
                  >
                    <div class="md:w-1/3">
                      <label
                        class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4 text-lg w-64"
                        for="inline-full-name"
                      >
                        {{ Sector.Sector }}
                      </label>
                    </div>
                    <div class="md:w-2/3">
                      <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                        id="inline-full-name"
                        type="text"
                        v-model="Sector.Budget"
                      />
                    </div>
                  </div>

                  <div
                    v-if="newSectors.length"
                    class="md:flex md:items-center w-11/12 justify-end"
                  >
                    <div class="md:w-2/3">
                      <button
                        class="shadow bg-gray-500 hover:bg-black focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
                        type="submit"
                        @click="savenew()"
                      >
                        save
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <div
                v-bind:class="{
                  hidden: openTab !== 3,
                  block: openTab === 3,
                }"
              >
                <div class="py-4 w-[95%] bg-slate-700">
                  <select
                    class="select1 mt-1 block w-full rounded-md border-2 border-balck px-4 py-2 pl-3 pr-10 text-base focus:border-black focus:outline-none focus:ring-black sm:text-sm"
                    @change="onChangedelet($event)"
                    selectedyear
                  >
                    <option selected disabled value="0">
                      Please select one
                    </option>

                    <option
                      v-for="year in years"
                      :key="year.year"
                      :value="year.year"
                    >
                      {{ year.year }}
                    </option>
                  </select>
                </div>
                <form @submit.prevent="onSubmit" class="add-form py-4">
                  <div
                    v-for="Sector in deletSectors"
                    :key="Sector.Sector"
                    :value="Sector.Sector"
                    class="md:flex md:items-center mb-6"
                  >
                    <div class="md:w-1/3">
                      <label
                        class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4 text-lg w-64"
                        for="inline-full-name"
                      >
                        {{ Sector.Sector }}
                      </label>
                    </div>
                    <div class="md:w-2/3">
                      <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                        id="inline-full-name"
                        type="text"
                        v-model="Sector.Budget"
                      />
                    </div>
                  </div>

                  <div
                    v-if="deletSectors.length"
                    class="md:flex md:items-center"
                  >
                    <div class="md:w-1/3"></div>
                    <div
                      v-if="deletSectors.length"
                      class="md:flex md:items-center w-11/12 justify-end"
                    >
                      <div class="md:w-2/3">
                        <button
                          class="shadow bg-gray-500 hover:bg-black focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
                          type="submit"
                          @click="delet()"
                        >
                          حذف
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div
                v-bind:class="{
                  hidden: openTab !== 4,
                  block: openTab === 4,
                }"
              >
                <div class="flex flex-col w-full">
                  <div class="py-4 w-3/6 bg-slate-700">
                    <select
                      @change="getSectorstatistics($event)"
                      v-model="selectedItem"
                      class="select1 mt-1 block w-full rounded-md border-2 border-balck px-4 py-2 pl-3 pr-14 text-base focus:border-black focus:outline-none focus:ring-black sm:text-sm"
                    >
                      <option selected disabled value="0">
                        Please select one
                      </option>
                      <option
                        class=""
                        v-for="year in years"
                        :key="year.year"
                        :value="year.year"
                      >
                        {{ year.year }}
                      </option>
                    </select>
                  </div>
                  <div class="w-full">
                    <div
                      class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row"
                    >
                      <div
                        class="-mb-px mr-2 last:mr-0 flex-auto text-center"
                        v-for="(Sector, index) in budjetSector"
                        :key="Sector.Sector"
                        :value="Sector.Sector"
                      >
                        <a
                          class="text-xs font-bold uppercase px-5 py-4 my-2 shadow-lg rounded block leading-normal"
                          v-on:click="toggleTabsstatistic(index)"
                          v-bind:class="{
                            'text-green-600 bg-white cursor-pointer':
                              openTabstatistic !== index,
                            'text-white bg-green-600 cursor-pointer':
                              openTabstatistic === index,
                          }"
                        >
                          {{ Sector.Sector }}
                        </a>
                      </div>
                    </div>
                    <div
                      class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
                    >
                      <div class="px-4 py-5 flex-auto">
                        <div class="tab-content tab-space">
                          <div
                            v-for="(Sector, index) in budjetSector"
                            :key="Sector.Sector"
                            :value="Sector.Sector"
                            v-bind:class="{
                              hidden: openTabstatistic !== index,
                              block: openTabstatistic === index,
                            }"
                          >
                            <p>
                              <heading class="mb-6 mx-4">
                                {{ Sector.Sector }}</heading
                              >
                            </p>
                            <div class="space-y-8 divide-y divide-gray-200">
                              <div class="space-y-8 divide-y divide-gray-200">
                                <div class="pt-8">
                                  <div
                                    class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                                  >
                                    <div class="sm:col-span-6">
                                      <label
                                        for="street-address"
                                        class="block text-sm font-medium text-gray-700"
                                        >ميزانبة القطاع
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="street-address"
                                          id="street-address"
                                          autocomplete="street-address"
                                          :value="Sector.Budget"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-6">
                                      <label
                                        for="street-address"
                                        class="block text-sm font-medium text-gray-700"
                                      >
                                        مصاريف القطاع
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="street-address"
                                          id="street-address"
                                          autocomplete="street-address"
                                          :value="Sector.expenses_year"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-6">
                                      <label
                                        for="street-address"
                                        class="block text-sm font-medium text-gray-700"
                                      >
                                        صافي الانفاق القطاع
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="street-address"
                                          id="street-address"
                                          autocomplete="street-address"
                                          :value="
                                           ( Sector.Budget - Sector.expenses_year).toFixed(2)
                                          "
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <!--First Quarter -->
                                    <div class="sm:col-span-2">
                                      <label
                                        for="city"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الاول ميزانية
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="city"
                                          id="city"
                                          autocomplete="address-level2"
                                          :value="Sector.Budget / 4"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                      <label
                                        for="region"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الاول مصاريف</label
                                      >
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="region"
                                          id="region"
                                          autocomplete="address-level1"
                                          :value="Sector.expenses_First"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                      <label
                                        for="postal-code"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الاول صافي الانفاق</label
                                      >
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="postal-code"
                                          id="postal-code"
                                          autocomplete="postal-code"
                                          :value="
                                            (Sector.Budget / 4 -
                                            Sector.expenses_First).toFixed(2)
                                          "
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <!--Second Quarter -->
                                    <div class="sm:col-span-2">
                                      <label
                                        for="city"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الثاني ميزانية
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="city"
                                          id="city"
                                          autocomplete="address-level2"
                                          :value="Sector.Budget / 4"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                      <label
                                        for="region"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الثاني مصاريف
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="region"
                                          id="region"
                                          autocomplete="address-level1"
                                          :value="Sector.expenses_Second"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                      <label
                                        for="postal-code"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الثاني صافي الانفاق
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="postal-code"
                                          id="postal-code"
                                          autocomplete="postal-code"
                                          :value="
                                           ( Sector.Budget / 4 -
                                            Sector.expenses_Second).toFixed(2)
                                          "
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <!--Third quarter  -->
                                    <div class="sm:col-span-2">
                                      <label
                                        for="city"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الثالت ميزانية
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="city"
                                          id="city"
                                          autocomplete="address-level2"
                                          :value="Sector.Budget / 4"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                      <label
                                        for="region"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الثالت مصاريف
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="region"
                                          id="region"
                                          autocomplete="address-level1"
                                          :value="Sector.expenses_Third"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                      <label
                                        for="postal-code"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الثالت صافي الانفاق
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="postal-code"
                                          id="postal-code"
                                          autocomplete="postal-code"
                                          :value="
                                           ( Sector.Budget / 4 -
                                            Sector.expenses_Third).toFixed(2)
                                          "
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <!-- The fourth quarter  -->
                                    <div class="sm:col-span-2">
                                      <label
                                        for="city"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الرابع ميزانية
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="city"
                                          id="city"
                                          autocomplete="address-level2"
                                          :value="Sector.Budget / 4"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                      <label
                                        for="region"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الرابع مصاريف
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="region"
                                          id="region"
                                          autocomplete="address-level1"
                                          :value="Sector.expenses_fourth"
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                      <label
                                        for="postal-code"
                                        class="block text-sm font-medium text-gray-700"
                                        >الربع الرابع صافي الانفاق
                                      </label>
                                      <div class="mt-1">
                                        <input
                                          readonly
                                          type="text"
                                          name="postal-code"
                                          id="postal-code"
                                          autocomplete="postal-code"
                                          :value="
                                            Sector.Budget / 4 -
                                            Sector.expenses_fourth
                                          "
                                          class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="md:flex justify-between mt-5 text-center">
                              <div class="mb-4 md:mb-0 md:w-1/2">
                                <pure-vue-chart
                                  class="chart-custom-style"
                                  :points="[  Sector.expenses_First, Sector.expenses_Second, Sector.expenses_Third, Sector.expenses_fourth]"
                                  :show-y-axis="true"
                                  :show-x-axis="true"
                                  :width="400"
                                  :height="200"
                                  :show-values="true"
                                  :use-month-labels="true"
                                  :use-points-labels="true"
                                  :months="[
                                    'Jan',
                                    'Fev',
                                    'Mar',
                                    'Abr',

                                  ]"
                                />
                                <h1>مخرجات</h1>
                              </div>
                              <div class="md:w-1/2">
                                <pure-vue-chart
                                class="chart-custom-style"
                                  :points="[Sector.income_First, Sector.income_Second,  Sector.income_Third,  Sector.income_fourth]"
                                  :show-y-axis="true"
                                  :show-x-axis="true"
                                  :width="400"
                                  :height="200"
                                  :show-values="true"
                                  :use-month-labels="true"
                                  :use-points-labels="true"
                                  :months="[
                                    'Jan',
                                    'Fev',
                                    'Mar',
                                    'Abr',

                                  ]"
                                />
                                <h1>مدخلات</h1>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PureVueChart from "pure-vue-chart";
export default {
  data() {
    return {
      openTab: 1,
      openTabstatistic: 0,
      selectedItem: "0",
      selectedyear: "0",
      year: "0",
      years: [],
      Sectors: [],
      newSectors: [],
      budjetSector: [],
      deletSectors: [],
      points: [1, 4, 5, 3, 60, 4, 5, 3, 60, 4, 5],
      months: [
        "Jan",
        "Fev",
        "Mar",
        "Abr",
        "Mai",
        "Jun",
        "Jul",
        "Ago",
        "Set",
        "Out",
        "Nov",
        "Dez",
      ],
      projectshow: false,
    };
  },
  methods: {
    toggleTabs: function (tabNumber) {
      this.openTab = tabNumber;
    },
    toggleTabsstatistic: function (tabNumber) {
      this.openTabstatistic = tabNumber;
    },
    getYears: function () {
      axios.post("/year").then((response) => {
        this.years = response.data;
      });
    },

    getSector: function () {
      axios.post("/Sectors").then((response) => {
        this.newSectors = response.data;
      });
    },
    getSectorstatistics(event) {
      axios
        .post("/Sectorstatistics", {
          year: event.target.value,
        })
        .then((response) => {
          this.budjetSector = response.data;
        });
    },

    onChange(event) {
      axios
        .post("/SectorsBudget", {
          year: event.target.value,
        })
        .then((response) => {
          this.Sectors = response.data;
          console.log("sss", this.Sectors);
        });
    },
    onChangedelet(event) {
      axios
        .post("/SectorsBudget", {
          year: event.target.value,
        })
        .then((response) => {
          this.deletSectors = response.data;
          this.selectedItem = "0";
          this.selectedyear = "0";
          this.year = event.target.value;
        });
    },
    save() {
      axios.post("/save", {
        year: this.year,
        Sectors: this.Sectors,
      }).then(function (response) {
            toastr.options = {
              closeButton: true,
              debug: false,
              positionClass: "toast-bottom-right",
              onclick: null,
              showDuration: "300",
              hideDuration: "2000",
              showMethod: "fadeIn",
              hideMethod: "fadeOut",
            };
            toastr.success("  تم حفظ بنجاح");
          });;
    },
    savenew() {
      let sum = 0;
      this.newSectors.forEach((element) => {
        sum += parseInt(element["Budget"]);
      });

      console.log(sum);
      // alert(this.budgetsOfyear);
      if (this.budgetsOfyear > sum) {
        axios
          .post("/save", {
            year: this.newyear,
            budgetsOfyear: this.budgetsOfyear,
            Sectors: this.newSectors,
          })
          .then(function (response) {
            toastr.options = {
              closeButton: true,
              debug: false,
              positionClass: "toast-bottom-right",
              onclick: null,
              showDuration: "300",
              hideDuration: "2000",
              showMethod: "fadeIn",
              hideMethod: "fadeOut",
            };
            toastr.success("  تم انشاء بنجاح");
          });

        this.getYears();
      } else {
        toastr.options = {
          closeButton: true,
          debug: false,
          positionClass: "toast-bottom-right",
          onclick: null,
          showDuration: "300",
          hideDuration: "2000",
          showMethod: "fadeIn",
          hideMethod: "fadeOut",
        };

        toastr.error("ميزانية السنة لا تطابق مع ميزانية القطاعات");
      }
    },
    delet() {

      // console.log(this.deletSectors);
      axios.post("/delet", {
        year: this.year,
      });
      this.deletSectors = [];
      this.getYears();
    },
  },

  beforeMount() {
    this.getYears();
    this.getSector();
  },
  components: {
    PureVueChart,
  },
};
</script>
<style>
  /* .chart-custom-style {
    width:500px !important;
    height: 300px !important;
  } */
</style>
