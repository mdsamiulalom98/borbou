
<!-- Modal -->
<div class="modal fade payup-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="padding: 15px;">
        <!-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> -->
        <button style="opacity: 1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="padding: 15px 20px 10px;">
        <div class="modal-body-wrapper">
            
            <div class="modal-logo">
                <img src="{{ asset($generalsetting->white_logo) }}" alt="">
            </div>
            <div class="modal-description">
                <p>রেজিস্ট্রেশন ফি মাত্র <span class="price-amount">৪৯৯</span> টাকা</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
         <form action="{{route('member.member_publish')}}" method="POST">
             @csrf
            <button class="btn submit-secondary" style="margin-top: 0; margin-bottom: 0">পেমেন্ট করুন </button> 
         </form>
        
      </div>
    </div>
  </div>
</div>