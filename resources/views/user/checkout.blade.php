@extends('layouts.navigation.user')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Checkout
            </div>
            <div class="card-body">
                <div class="row">
                    <form id='form-checkout' class="col-md-8 px-2" method="POST" action="{{route('user.finish_order')}}">
                        <div class="shadow-sm p-2">
                            <h4>Payment Methods</h4>

                            <div class="border-top border-bottom py-2 ps-2">
                                <input type="radio" name="payment_method" class='payment_method_select' value="money" id='money' checked>
                                <label for="money">Money</label>
                            </div>

                            <div class="border-bottom py-2 ps-2">
                                <input type="radio" name="payment_method" class="payment_method_select"  value="card" id='card'>
                                <label for="money">Card</label>

                                <div class="row mt-2">
                                    <div class="col-md-7 mb-3 mb-md-0">
                                        <div class="col-12">
                                            <div class="position-relative">
                                                <input
                                                type="text"
                                                name="card_number"
                                                id="form-checkout__cardNumber"
                                                class="form-control"
                                                style="padding-left: 3em"
                                                placeholder="Enter Card Number"
                                                disabled
                                                >
                                                <i class="bi bi-credit-card position-absolute text-secondary" style="top: 50%; left: 15px; font-size:1.5em; transform: translateY(-50%)"></i>
                                            </div>
                                            @error('card_number')
                                                    <strong class="text-danger">{{ $errors->get('card_number')[0] }}</strong>
                                            @enderror

                                            <div class="position-relative mt-4">
                                                <input
                                                type="text"
                                                name="card_holder"
                                                id="form-checkout__cardholderName"
                                                class="form-control"
                                                style="padding-left: 3em"
                                                placeholder="Enter Card Holder"
                                                disabled
                                                >
                                                <i class="bi bi-person-circle position-absolute text-secondary" style="top: 50%; left: 15px; font-size:1.5em; transform: translateY(-50%)"></i>
                                            </div>
                                            @error('card_holder')
                                                    <strong class="text-danger">{{ $errors->get('card_holder')[0] }}</strong>
                                            @enderror
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <div class="position-relative">
                                                    <input
                                                    type="text"
                                                    name="card_date"
                                                    id="form-checkout__expirationDate"
                                                    class="form-control"
                                                    style="padding-left: 3em"
                                                    placeholder="MM / YY"
                                                    disabled
                                                    >
                                                    <i class="bi bi-calendar3 position-absolute text-secondary" style="top: 50%; left: 15px; font-size:1.5em; transform: translateY(-50%)"></i>
                                                </div>
                                                @error('card_date')
                                                    <strong class="text-danger">{{ $errors->get('card_date')[0] }}</strong>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="position-relative">
                                                    <input
                                                    type="text"
                                                    name="card_verification"
                                                    id="form-checkout__securityCode"
                                                    class="form-control"
                                                    style="padding-left: 3em"
                                                    placeholder="CVV"
                                                    disabled
                                                    >
                                                    <i class="bi bi-upc position-absolute text-secondary" style="top: 50%; left: 15px; font-size:1.5em; transform: translateY(-50%)"></i>
                                                </div>
                                                @error('card_verification')
                                                    <strong class="text-danger">{{ $errors->get('card_verification')[0] }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <input type="text" name="identificationNumber" class="form-control" id="form-checkout__identificationNumber" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-center position-relative">
                                        <img src="{{asset('img/icon.png')}}" alt="credit-card" class="w-100">
                                        <img src="" class="position-absolute bg-white rounded-2 p-2" style="top: 25px; right: 25px;" id='thumbnail_card_template'>
                                        <h5 class="position-absolute text-white" style="bottom: 60px; left: 25px;" id='number_card_template'>3211 1233 1511 1511</h5>
                                        <h6 class="position-absolute text-white" style="bottom: 35px; left: 25px;" id='valid_card_template'>05 / 18</h6>
                                        <h6 class="position-absolute text-white" style="bottom: 6px; left: 25px;" id='holder_name_card_template'>Fulano de tal</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="email" class="d-none" name="cardholderEmail" id="form-checkout__cardholderEmail"/>
                        <select name="issuer" class="d-none" id="form-checkout__issuer"></select>
                        <select name="installments" class="d-none" id="form-checkout__installments"></select>
                        <select name="identificationType" class="d-none" id="form-checkout__identificationType"></select>


                        <button type="submit" class="btn btn-primary mt-3">Finish Order</button>
                        <progress value="0" class="progress-bar d-none">loading...</progress>
                    </form>


                    <div class="col-md-4">
                        <h5>Your Order</h5>
                        <hr>
                        <table class="table table-borderless ">
                            <thead>
                                <tr class="align-items-center">
                                    <th scope="col">Product</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $key => $item)
                                    <tr class={{$key % 2 === 0 ? 'bg-light' : ''}}>
                                        <td>{{ $item['main_text'] }}&nbsp;&nbsp;<strong>x{{ $item['count'] }}</strong></td>
                                        <td>
                                            @if (preg_match('/\w(.*)/', $item['price'], $price_number))
                                                $ {{ $price_number[0] * $item['count'] }}
                                                @php
                                                    $subtotal_items[] = $price_number[0] * $item['count'];
                                                @endphp
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td >Subtotal</td>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($subtotal_items); $i++)
                                        @php
                                            $subtotal = $subtotal + $subtotal_items[$i];
                                        @endphp
                                    @endfor
                                    <td id='subtotal'>$ {{ $subtotal }}</td>
                                </tr>

                                <tr>
                                    <td >Delivery</td>
                                    <td id='delivery_value'>$ {{$delivery_value}}</td>
                                </tr>

                                <tr >
                                    <td >Total</td>
                                    <td ><span>$</span> <span id='total_value'>{{$subtotal + $delivery_value}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("{!!env('PAYMENT_GATEWAY_PUBLIC_KEY')!!}", {
            locale: 'en-US',
        });

    const cardForm = mp.cardForm({
    amount: document.getElementById('total_value').innerText,
    autoMount: true,
    form: {
    id: "form-checkout",
    cardholderName: {
      id: "form-checkout__cardholderName",
      placeholder: "Card Holder",
    },
    cardNumber: {
      id: "form-checkout__cardNumber",
      placeholder: "Card Number",
    },
    expirationDate: {
      id: "form-checkout__expirationDate",
      placeholder: "MM/YYYY",
    },
    securityCode: {
      id: "form-checkout__securityCode",
      placeholder: "CVV",
    },
    installments: {
      id: "form-checkout__installments",
      placeholder: "Parcelas",
      value: 1
    },
    identificationType: {
      id: "form-checkout__identificationType",
      placeholder: "Tipo de documento",
      value: 'cpf'
    },
    identificationNumber: {
      id: "form-checkout__identificationNumber",
      placeholder: "identification number",
    },
    issuer: {
      id: "form-checkout__issuer",
      placeholder: "Banco emissor",
    },
  },
  callbacks: {
    onFormMounted: error => {
      if (error) return console.warn("Form Mounted handling error: ", error);
      console.log("Form mounted");
    },
    onSubmit: event => {
      event.preventDefault();
      const {
        paymentMethodId: payment_method_id,
        issuerId: issuer_id,
        cardholderEmail: email,
        amount,
        token,
        installments,
        identificationNumber,
        identificationType,
      } = cardForm.getCardFormData();

      fetch("/process_payment", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          token,
          issuer_id,
          payment_method_id,
          transaction_amount: {
            delivery: {!!$delivery_value!!},
            subtotal: parseFloat(amount)-parseFloat({!!$delivery_value!!}),
            total: parseFloat(amount)
          },
          address: JSON.parse('{!!$address!!}'),
          installments: Number(installments),
          description: "Descrição do produto",
          payer: {
            email,
            identification: {
              type: identificationType,
              number: identificationNumber,
            },
          },
        }),
      }).then(res => {
            if(res.ok){
                return res.json()
            }
      })
      .then(res => {
          if(typeof res !== 'undefined'){
              if(res.success){
                window.location.href = res.generated_payment
              }
          }
      });
    },
    onFetching: (resource) => {
      console.log("Fetching resource: ", resource);

      // Animate progress bar
      const progressBar = document.querySelector(".progress-bar");
      progressBar.removeAttribute("value");

      return () => {
        progressBar.setAttribute("value", "0");
      };
    },
  },
});
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let card_number_input = new window.Cleave('#form-checkout__cardNumber', {
                creditCard: true,
                onCreditCardTypeChanged: function (type) {
                    // update UI ...
                }
            });

            let date = new window.Cleave('#form-checkout__expirationDate', {
                date: true,
                datePattern: ['m', 'y']
            });

            //SetCardInputsActiveOrInactive
            if (document.querySelector('input[name="payment_method"]')) {
                document.querySelectorAll('input[name="payment_method"]').forEach((elem) => {
                    elem.addEventListener("change", function(event) {
                    var item = event.target.value;
                        if(item === 'card'){
                            event.target.parentNode.querySelectorAll('input[type="text"]').forEach(i => i.disabled = false)
                        }else{
                            document.querySelectorAll('input[type="text"]').forEach(i => i.disabled = true)
                        }
                    });
                });
            }
        })

        let cardData = {!!json_encode($payment_methods['card'])!!}

        //Set the card Image by the number
        document.getElementById('form-checkout__cardNumber').addEventListener('input', e => {
            document.getElementById('number_card_template').innerText = e.target.value.slice(0, e.target.maxLength)
            if(e.target.value.length > 6){
                let cd = Object.values(cardData).filter(({settings}) => {
                        return e.target.value.match(new RegExp((settings.length > 0) && settings[0].bin.pattern, 'g'))
                })
                document.getElementById('form-checkout__issuer').value = cd[0].id
                document.getElementById('thumbnail_card_template').src = cd[0].thumbnail
            }
        })

        //Change name in card template
        document.getElementById('form-checkout__cardholderName').addEventListener('input', e => document.getElementById('holder_name_card_template').innerText = e.target.value.slice(0, e.target.maxLength))

        //change date in card template
        document.getElementById('form-checkout__expirationDate').addEventListener('input', e => {
            document.getElementById('valid_card_template').innerText = e.currentTarget.value
        })





    </script>
@endsection
