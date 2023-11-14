<div>
    @if ($this->key=='Donations')


    <button id='clickButton' wire:click="Donations"  hidden>Click Me</button>
   @elseif ($this->key=='PaymentVoucher')
   <button id='clickButton' wire:click="PaymentVoucher" hidden>Click Me</button>
   @elseif ($this->key=='Address')
   <button id='clickButton' wire:click="Address" hidden>Click Me</button>
   @elseif ($this->key=='Alhisalat')
   <button id='clickButton' wire:click="Alhisalat" hidden>Click Me</button>
   @elseif ($this->key=='Area')
   <button id='clickButton' wire:click="Area" hidden>Click Me</button>
   @elseif ($this->key=='Users')
   <button id='clickButton' wire:click="Users" hidden>Click Me</button>
   @elseif ($this->key=='Cites')
   <button id='clickButton' wire:click="Cites" hidden>Click Me</button>
   @elseif ($this->key=='BusesCompany')
   <button id='clickButton' wire:click="BusesCompany" hidden>Click Me</button>

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
            setTimeout(function(){  window.close(); }, 4000);


        }

    </script>
</div>
