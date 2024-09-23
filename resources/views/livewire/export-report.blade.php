<div class="container mx-auto sm:px-6 lg:px-8">
    <div class="flex flex-row items-center justify-center mx-8 mt-12">
        <img class="h-[200px] lg:h-auto lg:w-auto" src="{{ asset('/assets/image/iuktui.png') }}" alt="alaqsa Logo">
    </div>
    <div class="flex-col justify-start p-5">

        <div class="mb-8">
            <div class="grid grid-cols-1 gap-3 md:gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 mb-4">
                <div class=" h-12 my-2 mb-4">
                    <label for="dateType" class="block text-sm pr-2 pb-1 text-[#349A37]">نوع التاريخ الذي تريد
                        عرضه</label>
                    <select pla wire:model.defer="dateType" id="dateType" name="dateType"
                        wire:change='onChange("dateType")'
                        class="selectwhorkHour block w-full text-[#349A37] border-[#349A37] border rounded-[60px] sm:text-sm px-4 h-10 placeholder-[#349A37] focus:ring-[#349A37] focus:border-[#349A37]">
                        <option {{ $dateType == 1 ? 'selected' : '' }} value="1">تاريخ السند</option>
                        <option {{ $dateType == 2 ? 'selected' : '' }} value="2">تاريخ الدفعة</option>
                    </select>
                </div>
                <div class="h-12 my-1 mb-4">
                    <label for="dateType" class="block text-sm pr-2 pb-1 text-[#349A37]">طريقة الدفع</label>
                    <select pla wire:model.defer="PaymentType" name="PaymentType" wire:change='onChange("PaymentType")'
                        class="selectwhorkHour block w-full text-[#349A37] border-[#349A37] border rounded-[60px] sm:text-sm px-4 h-10 placeholder-[#349A37] focus:ring-[#349A37] focus:border-[#349A37]">
                        <option {{ $PaymentType == 0 ? 'selected' : '' }} value="0">{{ __('all') }}</option>
                        <option {{ $PaymentType == 1 ? 'selected' : '' }} value="1">{{ __('cash') }}</option>
                        <option {{ $PaymentType == 2 ? 'selected' : '' }} value="2">{{ __('shek') }}</option>
                        <option {{ $PaymentType == 3 ? 'selected' : '' }} value="3">{{ __('bit') }}</option>
                        <option {{ $PaymentType == 4 ? 'selected' : '' }} value="4">{{ __('hawale') }}</option>
                        <option {{ $PaymentType == 5 ? 'selected' : '' }} value="5">{{ __('Hassale') }}</option>
                    </select>

                </div>

                <div class=" h-12 my-1 mb-4">
                    <label for="" class="block text-sm pr-2 pb-1 text-[#349A37]">تاريخ البداية</label>
                    <input type="date" name="" id="" wire:model.defer="from"
                        wire:change='onChange("from")'
                        class="block w-full text-[#349A37] border-[#349A37] border rounded-[60px] sm:text-sm px-4 h-10 placeholder-[#349A37] focus:ring-[#349A37] focus:border-[#349A37]">
                </div>

                <div class=" h-12 my-1 mb-4">
                    <label for="" class="block text-sm pr-2 pb-1 text-[#349A37]">تاريخ النهاية</label>
                    <input wire:model.defer="to" wire:change='onChange("to")' type="date"
                        class="block w-full text-[#349A37] border-[#349A37] border rounded-[60px] sm:text-sm px-4 h-10 placeholder-[#349A37] focus:ring-[#349A37] focus:border-[#349A37]">
                </div>

                <!--end Picker -->
                <div class="h-12 my-1 mb-4 ">
                    <button wire:click="Report"
                        class="flex items-center justify-center mt-5 w-full duration-200 text-center px-10 lg:px-10 py-3 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#40b744] hover:text-white ">
                        <svg class="min-w-[20px] min-h-[20px]" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="20px"
                            height="20px">
                            <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                style="mix-blend-mode: normal">
                                <g transform="scale(5.12,5.12)">
                                    <path
                                        d="M28.875,0c-0.01953,0.00781 -0.04297,0.01953 -0.0625,0.03125l-28,5.3125c-0.47656,0.08984 -0.82031,0.51172 -0.8125,1v37.3125c-0.00781,0.48828 0.33594,0.91016 0.8125,1l28,5.3125c0.28906,0.05469 0.58984,-0.01953 0.82031,-0.20703c0.22656,-0.1875 0.36328,-0.46484 0.36719,-0.76172v-5h17c1.09375,0 2,-0.90625 2,-2v-34c0,-1.09375 -0.90625,-2 -2,-2h-17v-5c0.00391,-0.28906 -0.12109,-0.5625 -0.33594,-0.75391c-0.21484,-0.19141 -0.50391,-0.28125 -0.78906,-0.24609zM28,2.1875v4.34375c-0.13281,0.27734 -0.13281,0.59766 0,0.875v35.40625c-0.02734,0.13281 -0.02734,0.27344 0,0.40625v4.59375l-26,-4.96875v-35.6875zM30,8h17v34h-17v-5h4v-2h-4v-6h4v-2h-4v-5h4v-2h-4v-5h4v-2h-4zM36,13v2h8v-2zM6.6875,15.6875l5.46875,9.34375l-5.96875,9.34375h5l3.25,-6.03125c0.22656,-0.58203 0.375,-1.02734 0.4375,-1.3125h0.03125c0.12891,0.60938 0.25391,1.02344 0.375,1.25l3.25,6.09375h4.96875l-5.75,-9.4375l5.59375,-9.25h-4.6875l-2.96875,5.53125c-0.28516,0.72266 -0.48828,1.29297 -0.59375,1.65625h-0.03125c-0.16406,-0.60937 -0.35156,-1.15234 -0.5625,-1.59375l-2.6875,-5.59375zM36,20v2h8v-2zM36,27v2h8v-2zM36,35v2h8v-2z" />
                                </g>
                            </g>
                        </svg>
                        <span class="mr-2">تصدير Excel</span>
                    </button>
                </div>
            </div>

        </div>
        <div  style="width: 100%;" dir="ltr">

            <table dir="rtl" class="overflow-x-auto"
                style="border-collapse: collapse; width: 100%; margin-bottom: 20px; font-family: Arial, sans-serif; text-align: left;">
                <thead class="bg-[#349A37] text-center">
                    <tr >
                        <th style="border: 1px solid #ddd; padding: 8px;">{{ __('ID') }}</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">{{ __('bill_number') }}</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">{{ __('DATE') }} </th>
                        <th style="border: 1px solid #ddd; padding: 8px;">{{ __('Date Details') }} </th>
                        <th style="border: 1px solid #ddd; padding: 8px;">{{ __('Type') }} </th>
                        <th style="border: 1px solid #ddd; padding: 8px;">{{ __('Name') }} </th>
                        <th style="border: 1px solid #ddd; padding: 8px;">{{ __('Transaction Amount') }} </th>
                        <th style="border: 1px solid #ddd; padding: 8px;">{{ __('Payment Type') }} </th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($exportData as $item)
                        @isset($item['id'])
                            <tr class="text-center bg-white">
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['id'] ?? 'N/A' }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['bill'] ?? 'N/A' }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['date'] ?? 'N/A' }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">
                                    {{ $item['dateDetails'] ?? ('N/A' ?? 'N/A') }}
                                </td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['type'] ?? 'N/A' }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['name'] ?? 'N/A' }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['transact_amount'] ?? 'N/A' }}
                                </td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['paymentTypeValue'] ?? 'N/A' }}
                                </td>
                            </tr>
                        @else
                            <tr class="bg-[#E4FFE585] text-center " >
                                <td style="border-top: 1px solid #ddd;  border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 8px;">
                                    {{ $item['0'] }}</td>
                                <td style="border-top: 1px solid #ddd;  border-bottom: 1px solid #ddd;  padding: 8px;">{{ $item['1'] ?? '' }}</td>
                                <td style="border-top: 1px solid #ddd;  border-bottom: 1px solid #ddd;  padding: 8px;">{{ $item['2'] ?? '' }}</td>
                                <td style="border-top: 1px solid #ddd;  border-bottom: 1px solid #ddd;  padding: 8px;">{{ $item['3'] ?? '' }}</td>
                                <td style="border-top: 1px solid #ddd;  border-bottom: 1px solid #ddd;  padding: 8px;">{{ $item['4'] ?? '' }}</td>
                                <td style="border-top: 1px solid #ddd;  border-bottom: 1px solid #ddd;  padding: 8px;">{{ $item['5'] ?? '' }}</td>
                                <td style="border-top: 1px solid #ddd;  border-bottom: 1px solid #ddd;  padding: 8px;"></td>
                                <td style="border-top: 1px solid #ddd;  border-bottom: 1px solid #ddd; border-left: 1px solid #ddd;  padding: 8px;"></td>
                            </tr>
                        @endisset
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>
