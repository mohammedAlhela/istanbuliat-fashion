     <!-- Modal -->
     <div class="modal fade" id="sizeGuideModel" tabindex="-1" role="dialog" aria-labelledby="sizeGuideModelTitle"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">

                     <div class="holder">

                         <div class="modal-title name" id="sizeGuideModelTitle">{{ $product->name }}</div>
                         <div class="report">
                             Size Chart informations
                         </div>
                     </div>


                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">




                     <div class="switches">
                         <span class="active"> centimeters</span>
                         <span>inches</span>
                     </div>




                     <div class="size-guide">

                         <div class="table-responsive">
                             <table class="size-guide-table">
                                 <thead>
                                     <tr>
                                         <th scope="col">Size</th>
                                         <th scope="col">Shoulder </th>
                                         <th scope="col">Bust</th>
                                         <th scope="col">Wist</th>
                                         <th scope="col">Hip</th>
                                         <th scope="col">Length</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <th scope="row">S</th>
                                         <td>18</td>
                                         <td>26.5</td>
                                         <td>7.75</td>
                                         <td>26.5</td>
                                         <td>7.75</td>
                                     </tr>
                                     <tr>
                                         <th scope="row">M</th>
                                         <td>20</td>
                                         <td>28.5</td>
                                         <td>8.25</td>
                                         <td>26.5</td>
                                         <td>7.75</td>
                                     </tr>
                                     <tr>
                                         <th scope="row">L</th>
                                         <td>22</td>
                                         <td>30.5</td>
                                         <td>9</td>
                                         <td>26.5</td>
                                         <td>7.75</td>
                                     </tr>
                                     <tr>
                                         <th scope="row">XL</th>
                                         <td>24</td>
                                         <td>31.5</td>
                                         <td>9.5</td>
                                         <td>26.5</td>
                                         <td>7.75</td>
                                     </tr>
                                     <tr>
                                         <th scope="row">2XL</th>
                                         <td>26</td>
                                         <td>32.5</td>
                                         <td>9.5</td>
                                         <td>26.5</td>
                                         <td>7.75</td>
                                     </tr>
                                     <tr>
                                         <th scope="row">3XL</th>
                                         <td>28</td>
                                         <td>33.5</td>
                                         <td>10</td>
                                         <td>26.5</td>
                                         <td>7.75</td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>


                         <div class="img">
                             <img src="/images/options/sizes/size-guid.png" alt="sizing guide" />
                         </div>

                         <div class="guide-informations-list">
                             <ol>



                                 @foreach (getSizeGuideListData() as $key => $item)
                                     <li>
                                         <span
                                             class="head">{{ array_search($item, getSizeGuideListData()) }}:</span>
                                         <span class="paragraph">
                                             {{ $item }}
                                         </span>
                                     </li>
                                 @endforeach


                             </ol>
                         </div>


                         <div class="img">
                             <img src="/images/options/sizes/size-guide2.png" alt="sizing guide" />
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Modal -->