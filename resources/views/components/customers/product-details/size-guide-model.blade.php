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




                     <div class="switches" id = "product_size_guide_switches">
                         <span  class="active switch" >centimeters</span>
                         <span class = "switch">inches</span>
                     </div>




                     <div class="size-guide">

                         <div class="table-responsive">
                             <table class="size-guide-table">
                                 <thead>
                                     <tr id = "size_guide_headings">
                                         <th scope="col">Size</th>
                                         <th scope="col">Shoulder(<span class = "unit">cm</span>) </th>
                                         <th scope="col">Bust(<span class = "unit">cm</span>)</th>
                                         <th scope="col">Wist(<span class = "unit">cm</span>)</th>
                                         <th scope="col">Hip(<span class = "unit">cm</span>)</th>
                                         <th scope="col">Length(<span class = "unit">cm</span>)</th>
                                     </tr>
                                 </thead>
                                 <tbody id = "size_guide_records">
                                     @foreach ($product->sizeGuides as $key => $guide)
                                         <tr >
                                             <th scope="row"> {{ $guide->size_name }}</th>
                                             <td>{{ $guide->shoulder }}</td>
                                             <td>{{ $guide->bust }}</td>
                                             <td>{{ $guide->wist }}</td>
                                             <td>{{ $guide->hip }}</td>
                                             <td>{{ $guide->length }}</td>
                                         </tr>
                                     @endforeach

                                 </tbody>
                             </table>
                         </div>


                         <div class="img">
                             <img src="/images/options/sizes/size-guid1.png" alt="sizing guide" />
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
