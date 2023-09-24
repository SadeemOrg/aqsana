<div>
    @if ($this->key=='Donations')


    <button id='clickButton' wire:click="Donations" >Click Me</button>
   @elseif ($this->key=='PaymentVoucher')
   <button id='clickButton' wire:click="PaymentVoucher" >Click Me</button>
   @elseif ($this->key=='Address')
   <button id='clickButton' wire:click="Address" >Click Me</button>
   @elseif ($this->key=='Alhisalat')
   <button id='clickButton' wire:click="Alhisalat" >Click Me</button>
   @elseif ($this->key=='Area')
   <button id='clickButton' wire:click="Area" >Click Me</button>
   @elseif ($this->key=='Users')
   <button id='clickButton' wire:click="Users" >Click Me</button>
   @elseif ($this->key=='Cites')
   <button id='clickButton' wire:click="Cites" >Click Me</button>
   @elseif ($this->key=='BusesCompany')
   <button id='clickButton' wire:click="BusesCompany" >Click Me</button>

    @endif
    <script>
        var button = document.getElementById('clickButton');

        window.onload = function() {
            $.when(funtion1()).then(function() {
                funtion2();
            })

        }
        function funtion1() {
            button.click()
        }

        function funtion2() {
            setTimeout(function(){  window.close(); }, 2000);


        }

    </script>
</div>
