<meta name="csrf-token" content="{{ csrf_token() }}" />

<table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Quantity</th>
  				          <th>Unit Price</th>
                    <th>Sub total</th>
  				        </tr>
                </thead>
  
                <tbody>
  
                  <?php
                    $total = 0;
                  ?>
                  @foreach($userCartItems as $item)
                  
                    <tr>
                      <td class="text-center"> 
                        <img width="70" src="{{$item['product']['picture']}}" alt=""/>
                      </td>
                      <td>{{$item['product']['title']}}<br/>{{$item['product']['artist']}}</td>
                      <td>
                          <div class="input-append">
                            <input class="span1" style="max-width:34px" value="{{$item['quantity']}}" id="appendedInputButtons" size="16" type="text">

                            <button class="btnItemUpdate btn_minus btn border btn-sm btn-outline-secondary" type="button" data-cartid="{{$item['id']}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>
                            <button class="btnItemUpdate btn_add btn btn-outline-secondary border btn-sm " type="button" data-cartid="{{$item['id']}}" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
                            </button>
                            <button class="btn-danger btn-sm border btnItemDelete" data-cartid="{{$item['id']}}" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                            </button>				
                          </div>
                      </td>
                      <td>{{$item['product']['price']}} &euro;</td>
                      <td>{{$item['product']['price'] * $item['quantity']}} &euro;</td>
                    </tr>
  
                    <?php
                    $total = $total + ($item['product']['price'] * $item['quantity']);
                    ?>
                  @endforeach
  
                  <tr>
                      <td colspan="4" style="text-align:right">Total Price:	</td>
                      <td> {{$total}} &euro;</td>
                    </tr>
                    <tr>
                      <td colspan="4" style="text-align:right">Shipping:	</td>
                      <td> 0.00 &euro;</td>
                    </tr>
                    <tr>
                      <td colspan="4" style="text-align:right"><strong>TOTAL</strong></td>
                      <td class="label label-important" style="display:block"> <strong> {{$total}} &euro;</strong></td>
                    </tr>
  				      </tbody>
                
            </table>