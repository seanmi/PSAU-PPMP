<?php $__env->startSection('xtraStyle'); ?>
<style>
    .header > h2, h6{
        line-height: 2px;

    }
    .header{
        text-align: center;
        margin-bottom: 4rem;
    }
    td {
        border-color: black !important;
        font-size: 1rem;
        height: 10px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
      
    }
    .table>tbody>tr>td{
        vertical-align: middle;
        border: 1px solid black !important;
    }
    @media  print {
        .categories {
            background-color: green !important;

        }
    }
    hr{
        margin-top: 0;
        margin-bottom: 0;
        border-top: 1px solid black;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <div class="row">
                <div class="col-md-9"><h1 >Consolidation</h1></div>
            </div>
        </div>
        <button class="btn btn primary" id="button">Print</button>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
            <div class="" id="print">
                    <div class="header">
                        <div>
                                <h6 class="first">Republic of the Philippines</h6>
                        </div>
                        <div>
                                <h3>Pampanga State Agricultural</h3>
                        </div>
                        <div>
                                <h6><i>PAC, San Agustin, Magalang, Pampanga</i></h6>
                        </div>
                        <div>
                                <h2>PROJECT PROCUREMENT MANAGEMENT PLAN 2019</h2>
                        </div>
                    </div>
                    <table class="table table-bordered" id="table">
                        <tbody>
                            <tr>
                                <td>Fund</td>
                                <td>101</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td rowspan="2" colspan="4"><span style="font-size:2rem">Grand Total</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Projects, Programs and Activities (PAPs)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td rowspan="2">Code</td>
                                <td rowspan="2">General Description</td>
                                <td rowspan="2">Units</td>
                                <td rowspan="2">Unit Price</td>
                                <td rowspan="2">Quantity/Size</td>
                                <td rowspan="2">Estimated Budget</td>
                                <td rowspan="2">Mode of Procurement</td>
                                <td colspan="4">Schedule Milestone of Activities</td>
                                <td rowspan="2">Note/Remarks if any changes</td>
                            </tr>
                            <tr>
                                <td >1st Quarter</td>
                                <td >2nd Quarter</td>
                                <td  >3rd Quarter</td>
                                <td>4th Quarter</td>
                            </tr>
                            <tr style="background-color:yellow;">
                                <td>50203010</td>
                                <td colspan="6">A-1. COMMON-USE OFFICE SUPPLIES</td>
                                <td colspan="5"></td>
                            </tr>

                            <?php if($categories->count() ==0): ?>
                            <tr> 
                                <td colspan="12" class="categories" style="text-align: center; background-color: green;"><i>No Item found</i></td>
                            </tr>   
                            <?php endif; ?>
                            
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr> 
                                <td colspan="12" class="categories" style="text-align: center; background-color: green;"><i><?php echo e($category->name); ?></i></td>
                            </tr>        
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->category_id == $category->id): ?>
                                        <tr> 
                                            
                                            <td></td>
                                            <td><?php echo e($item->general_description); ?></td>
                                            <td><?php echo e($item->unit); ?></td>
                                            <td><?php echo e($item->price); ?></td>
                                            <td> <?php echo e($item->total_quantity); ?></td>
                                            <td><?php echo e($item->total_estimated_budget); ?></td>
                                            <td><?php echo e($item->modeName); ?></td>
                                            <td ><?php echo e($item->total_q1); ?></td>
                                            <td><?php echo e($item->total_q2); ?></td>
                                            <td><?php echo e($item->total_q3); ?></td>
                                            <td><?php echo e($item->total_q4); ?></td>
                                            <td></td>
                                            
                                        </tr>                                          
                                    <?php endif; ?>                               
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
                            <tr >
                                <td style="border-color:white !important; border-bottom: black !important"></td>
                            </tr>
                            <tr >
                                    <td  colspan="2">Total Budget</td>
                                    <td colspan="3" style="text-align: right !important"> 
                                        ₱<?php echo e(number_format($items->sum('total_estimated_budget'), 2)); ?>

                                    </td>
                            </tr>
                            <tr>
                                <td colspan="2">+ 10% Provision for Inflation</td>
                                <td colspan="3" style="text-align: right !important">₱<?php echo e(number_format($items->sum('total_estimated_budget')* .10, 2)); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">+ 10% Contingency</td>
                                <td colspan="3" style="text-align: right !important">₱<?php echo e(number_format($items->sum('total_estimated_budget')* .10, 2)); ?></td>
                            </tr>
                            <tr>
                                    <td colspan="2"><strong>TOTAL ESTIMATED BUDGET:</strong></td>
                                    <td colspan="3" style="text-align: right !important">₱<?php echo e(number_format( (($items->sum('total_estimated_budget')* .10)*2)+ $items->sum('total_estimated_budget') ,  2)); ?></td>
                                </tr>
                            </table>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-4"> <strong> Prepared by</strong></div>
                        <div class="col-sm-4"> <strong>Recommending Approval</strong></div>
                        <div class="col-sm-4"> <strong>Approved by</strong></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-4"><strong></strong><br><hr></div>
                        <div class="col-sm-4"><strong></strong><br><hr></div>
                        <div class="col-sm-4"> <strong>HONORIO M. SORIANO JR.</strong> <hr></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-4">End User</div>
                        <div class="col-sm-4">VP</div>
                        <div class="col-sm-4">University President</div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
                                
                                <div class="modal fade" id="disapprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Remark</h4>
                                    </div>
                                    <form action="<?php echo e(route('budget.disapproved', ['id' => $item->id])); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="remarks" >
                                        </div>
                                
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-danger">Disapprove</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="text-center">
                              
                              </div>
                            
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
            calculateSum();
            function calculateSum(){
                var sum = 0;
                $('.estimated').each(function() {
                    sum += Number($(this).val());
                    
                    
                });
                $('#total').text("Total: ₱ "+sum.toFixed(2));
            }

            $('#button').on('click',function(){
            var printContents = document.getElementById('print').innerHTML;     
            var originalContents = document.body.innerHTML;       
            document.body.innerHTML = printContents;      
            window.print();      
            document.body.innerHTML = originalContents;
            window.location.reload(); 
        })

        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('bac.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>