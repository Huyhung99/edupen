(function ($) {
  Drupal.behaviors.mymodule = {
    attach: function (context, settings) {
      $(document).ready(function () {
        let i = 0;
        let choice = 1;
        $(document).on('click','.choice',function (e){
          e.preventDefault();
           choice = $('.choice[selected="selected"]').length;
          $('.js-answer-check').text(choice);
          let qa = '';
          q = $(this).data('q');
          $(`.choice[data-q=${q}]`).removeAttr('selected');
          $(this).attr('selected','selected');
          qa = '{\"data\":[';
          $('.choice[selected="selected"]').each(function (index,value){
            qna = $(this).data('value').split("-");
            qa = qa + `{"cau"` + ":" + "\"" + qna[0]  + "-"  + qna[1] + "\"}" + ',';
          })
          qa = qa.slice(0,-1) + ']}'
          // $(`#edit-field-cau-${question}-und`).find(`input[value=${answer}]`).prop("checked", true);
          $('#edit-field-dap-an-dung-und-0-value').val(qa);
        })
        let quantity = 0;
        $('#edit-field-so-cau-hoi-und').change(function (e){
          quantity = $(this).val();
          let title = `<span class="label">Điền đáp án đúng</span>: <span class="title-answer"><span class="js-answer-check">0</span>/<span>${quantity}</span></span>`;
          let multiples = '';
          for (let i = 1;i<=quantity;i++){
            multiples = multiples + `<div class="item-question" data-value="cau">${i}.
          <a class="choice" data-value="${i}-A" data-q="${i}" href="#">A</a>
          <a class="choice" data-value="${i}-B" data-q="${i}" href="#">B</a>
          <a class="choice" data-value="${i}-C" data-q="${i}" href="#">C</a>
          <a class="choice" data-value="${i}-D" data-q="${i}" href="#">D</a>
        </div>`
          }
          $('.js-multiple').html(title + `<div class="answers">${multiples}</div>`);
        })

        if ($('#edit-field-so-cau-hoi-und option:selected').val() !== '' && $('#edit-field-so-cau-hoi-und option:selected').length > 0){
          quantity = $('#edit-field-so-cau-hoi-und option:selected').val();
          let multiples = '';
          let title = `<span class="label">Điền đáp án đúng</span>: <span class="title-answer"><span class="js-answer-check">0</span>/<span>${quantity}</span></span>`;
          for (let i = 1;i<=quantity;i++){
            multiples = multiples + `<div class="item-question" data-value="cau">${i}.
          <a class="choice" data-value="${i}-A" data-q="${i}" href="#">A</a>
          <a class="choice" data-value="${i}-B" data-q="${i}" href="#">B</a>
          <a class="choice" data-value="${i}-C" data-q="${i}" href="#">C</a>
          <a class="choice" data-value="${i}-D" data-q="${i}" href="#">D</a>
        </div>`
          }
          $('.js-multiple').html(title + `<div class="answers">${multiples}</div>`);
          console.log($('#edit-field-dap-an-dung-und-0-value').val());
          answers = JSON.parse($('#edit-field-dap-an-dung-und-0-value').val());
          $(".js-answer-check").text(answers.data.length);
          console.log(answers.data[0]);
          answers.data.forEach(function(value,index){
            console.log(value);
            // let qna = value.split(':');
            $(`.choice[data-value="${value.cau}"]`).attr('selected','selected');
          })

          console.log(answers);
        }
        $(document).on('click','#de-thi-node-form #edit-actions #edit-submit',function (e){
          if($('.choice[selected="selected"]').length >= $('#edit-field-so-cau-hoi-und option:selected').val()){
            return true;
          }
          alert('Chưa nhập đủ đáp án đúng');
          return false;
        })
      })
    }
  };
})(jQuery);
