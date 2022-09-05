(function ($) {
  Drupal.behaviors.mymodule = {
    attach: function (context, settings) {
      $(document).ready(function () {
        let i = 0;
        let choice = 1;
        // $(document).on('click', '.choice', function (e) {
        //   e.preventDefault();
        //   choice = $('.choice[selected="selected"]').length;
        //   $('.js-answer-check').text(choice);
        //   let qa = '';
        //   q = $(this).data('q');
        //   $(`.choice[data-q=${q}]`).removeAttr('selected');
        //   $(this).attr('selected', 'selected');
        //   qa = '{\"data\":[';
        //   $('.choice[selected="selected"]').each(function (index, value) {
        //     qna = $(this).data('value').split("-");
        //     qa = qa + `{"cau"` + ":" + "\"" + qna[0] + "-" + qna[1] + "\"}" + ',';
        //   })
        //   qa = qa.slice(0, -1) + ']}'
        //   // $(`#edit-field-cau-${question}-und`).find(`input[value=${answer}]`).prop("checked", true);
        //   $('#edit-field-dap-an-dung-und-0-value').val(qa);
        //   $('.js-data-answer').val(qa);
        // })
        $(document).on('mouseup', '.choice', function (e) {
          e.preventDefault();
          console.log(1);
          const idForm = $(this).parentsUntil('form').parent();
          choice = idForm.find('.choice[selected="selected"]').length;
          idForm.find('.js-answer-check').text(choice);
          let qa = '';
          q = $(this).data('q');
          idForm.find(`.choice[data-q=${q}]`).removeAttr('selected');
          $(this).attr('selected', 'selected');
          qa = '{\"data\":[';
          idForm.find('.choice[selected="selected"]').each(function (index, value) {
            qna = $(this).data('value').split("-");
            qa = qa + `{"cau"` + ":" + "\"" + qna[0] + "-" + qna[1] + "\"}" + ',';
          })
          qa = qa.slice(0, -1) + ']}'
          // $(`#edit-field-cau-${question}-und`).find(`input[value=${answer}]`).prop("checked", true);
          idForm.prev().find('textarea').val(qa);
          // $('.js-data-answer').val(qa);
        })

        let quantity = 0;
        $('.form-item-field-so-cau-hoi-und select ').on('change', function (e) {
          quantity = $(this).find('option:selected').val();
          let title = `<span class="label">Điền đáp án đúng</span>: <span class="title-answer"><span class="js-answer-check">0</span>/<span>${quantity}</span></span>`;
          let multiples = '';
          for (let i = 1; i <= quantity; i++) {
            multiples = multiples + `<div class="item-question" data-value="cau">${i}.
          <a class="choice" data-value="${i}-A" data-q="${i}" href="#">A</a>
          <a class="choice" data-value="${i}-B" data-q="${i}" href="#">B</a>
          <a class="choice" data-value="${i}-C" data-q="${i}" href="#">C</a>
          <a class="choice" data-value="${i}-D" data-q="${i}" href="#">D</a>
        </div>`
          }
          $(this).parentsUntil('form').find('.js-multiple').html(title + `<div class="answers">${multiples}</div>`)
        })

        $('.form-item-field-so-cau-hoi-und select').each(function (e) {
          if ($(this).find('option:selected').val() !== "_none") {
            quantity = $(this).find('option:selected').val();
            let multiples = '';
            let title = `<span class="label">Điền đáp án đúng</span>: <span class="title-answer"><span class="js-answer-check">0</span>/<span>${quantity}</span></span>`;
            for (let i = 1; i <= quantity; i++) {
              multiples = multiples + `<div class="item-question" data-value="cau">${i}.
          <a class="choice" data-value="${i}-A" data-q="${i}" href="#">A</a>
          <a class="choice" data-value="${i}-B" data-q="${i}" href="#">B</a>
          <a class="choice" data-value="${i}-C" data-q="${i}" href="#">C</a>
          <a class="choice" data-value="${i}-D" data-q="${i}" href="#">D</a>
        </div>`
            }
            $(this).parentsUntil('form').find('.js-multiple').html(title + `<div class="answers">${multiples}</div>`);
            $(this).parentsUntil('form').find('.js-multiple').prev().addClass('d-none');
            if ($(this).parentsUntil('form').find('.js-multiple').prev().find('textarea').val() !== '') {
              answers = JSON.parse($(this).parentsUntil('form').find('.field-name-field-dap-an-dung textarea').val());
              $(this).parentsUntil('form').find('.js-multiple .js-answer-check').text(answers.data.length);
              for (let j = 0; j < answers.data.length; j++) {
                $(this).parentsUntil('form').find(`.js-multiple .choice[data-value="${answers.data[j].cau}"]`).attr('selected', 'selected');
              }
            }
          } else {
            $('.js-multiple').html('');
          }
        })

        $(document).on('click', '#de-thi-node-form #edit-actions #edit-submit', function (e) {
          if ($('.choice[selected="selected"]').length >= $('#edit-field-so-cau-hoi-und option:selected').val()) {
            return true;
          }
          alert('Chưa nhập đủ đáp án đúng');
          return false;
        })
        if ($('.js-de-thi').length > 0) {

          const timeDown = $('.js-de-thi').data('time');
          var price = parseInt($('.js-de-thi').data('price'));
          if (price == 0) {
            formated_price = 'Miễn phí';
          } else {
            formated_price = price.toLocaleString("it-IT") + 'đ';
          }
          let quantity = $('.js-de-thi').data('question');
          let title = `<span class="label-de-thi">Chọn câu trả lời: </span> <span class="title-answer"><span class="js-answer-check">0</span>/<span>${quantity}</span></span><span class="countdown" ><i class="far fa-alarm-clock"></i> ${timeDown}:00</span>`;
          let multiples = '';
          for (let i = 1; i <= quantity; i++) {
            multiples = multiples + `<div class="item-question" data-value="cau">${i}.
          <a class="choice disabled" data-value="${i}-A" data-q="${i}" href="#">A</a>
          <a class="choice disabled" data-value="${i}-B" data-q="${i}" href="#">B</a>
          <a class="choice disabled" data-value="${i}-C" data-q="${i}" href="#">C</a>
          <a class="choice disabled" data-value="${i}-D" data-q="${i}" href="#">D</a>
        </div>`
          }
          $('.js-de-thi').html(title + `<div class="answers">${multiples}</div>`
            + `<div class="tutor-course-price-preview__btn">
                                        <a class="btn btn-primary btn-hover-secondary w-100 js-start-assignment"> Bắt đầu thi (${formated_price}) </a>
                                        <a class="btn btn-primary btn-hover-secondary w-100 js-submit-assignment d-none"> Nộp bài </a>
                                        <input type="hidden" value="" class="js-data-answer">
                                    </div>`);
        }
        let isPaused = false;
        $('.js-start-assignment').click(function (e) {
          e.preventDefault();
          if ($('.js-udata').val() != 0) {
            var price = parseInt($('.js-de-thi').data('price'));
            var balance = parseInt($('.js-balance').val());
            if (price > balance) {
              $.confirm({
                title: 'Thông báo',
                content: 'Ví bạn không đủ để ',
                buttons: {
                  confirm: {
                    text: 'Nạp tiền',
                    btnClass: 'btn-primary',
                    action: function () {
                      window.location.href = 'https://edupen.vn/user/';
                    },
                  },
                  cancel: {
                    text: 'Huỷ',
                    action: function () {

                    },
                  }

                }
              });
            } else {
              $('.choices').removeClass('disabled');
              let assignment = $('.js-data-answer').val();
              let examID = $('.js-de-thi').data('value');
              let uid = $('.js-udata').val();
              let questions = $('.js-de-thi').data('question');
              if ($('.js-data-eid').length > 0) {
                answers = JSON.parse($('.js-data-answer').val());
                $(".js-answer-check").text(answers.data.length);
                answers.data.forEach(function (value, index) {
                  // let qna = value.split(':');
                  $(`.choice[data-value="${value.cau}"]`).attr('selected', 'selected');
                });
                $('.js-submit-assignment').removeClass('d-none');
                $('.js-start-assignment').addClass('d-none');
                let leaveTime = $('.js-de-thi .countdown').text().split(':');
                let timeDown = leaveTime[0] * 60 + leaveTime[1] * 1;
                let duration = moment.duration(timeDown * 1000, 'milliseconds');
                const interval = 1000;
                const countdown = document.querySelector('.countdown');
                setInterval(() => {
                  let eid = $('.js-data-eid').val();
                  if (!isPaused) {
                    duration = moment.duration(duration - interval, 'milliseconds');
                    countdown.innerText = duration.minutes() + ":" + duration.seconds();
                    let assignment = $('.js-data-answer').val();
                    let examID = $('.js-de-thi').data('value');
                    let uid = $('.js-udata').val();
                    let questions = $('.js-de-thi').data('question');
                    let leaveTime = $('.js-de-thi .countdown').text();
                    $.ajax({
                      url: 'https://edupen.vn/cap-nhat-bai-lam',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                        data: {
                          assignment: assignment,
                          exam_id: examID,
                          uid: uid,
                          questions: questions,
                          eid: eid,
                          leaveTime: leaveTime
                        }
                      }
                    }).done(function (response) {
                      console.log(response);
                    })
                  }
                }, interval);
              } else {

                $.ajax({
                  url: 'https://edupen.vn/luu-bai-lam',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    data: {
                      assignment: assignment,
                      exam_id: examID,
                      uid: uid,
                      questions: questions
                    }
                  }
                }).done(function (data) {
                  console.log(data);
                  $('.js-submit-assignment').removeClass('d-none');
                  $('.js-start-assignment').addClass('d-none');
                  $('.js-data-answer').after(`<input type="hidden" value="${data.response}" class="js-data-eid">`);
                  const timeDown = $('.js-de-thi').data('time') * 60;
                  let duration = moment.duration(timeDown * 1000, 'milliseconds');
                  const interval = 1000;
                  const countdown = document.querySelector('.countdown')
                  let eid = $('.js-data-eid').val();
                  setInterval(() => {
                    if (!isPaused) {
                      duration = moment.duration(duration - interval, 'milliseconds');
                      countdown.innerText = duration.minutes() + ":" + duration.seconds();
                      let assignment = $('.js-data-answer').val();
                      let examID = $('.js-de-thi').data('value');
                      let uid = $('.js-udata').val();
                      let questions = $('.js-de-thi').data('question');
                      let leaveTime = $('.js-de-thi .countdown').text();
                      $.ajax({
                        url: 'https://edupen.vn/cap-nhat-bai-lam',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                          data: {
                            assignment: assignment,
                            exam_id: examID,
                            uid: uid,
                            questions: questions,
                            eid: eid,
                            leaveTime: leaveTime
                          }
                        }
                      }).done(function (response) {
                      })
                    }
                  }, interval);
                });
              }
            }
          } else {
            $.confirm({
              title: 'Đăng nhập',
              content: 'Hãy đăng nhập để có thể vào thi',
              buttons: {
                confirm: {
                  text: 'Đăng nhập',
                  btnClass: 'btn-primary',
                  action: function () {
                    window.location.href = 'https://edupen.vn/user/login';
                  },
                },
                cancel: {
                  text: 'Huỷ',
                  action: function () {

                  },
                }

              }
            });
          }
        });
        let uid = $('.js-udata').val();
        $(document).on('click', '.js-submit-assignment', function (e) {
          e.preventDefault();
          isPaused = true;
          $.session.clear();
          $.ajax({
            url: 'https://edupen.vn/cap-nhat-trang-thai-thi',
            type: 'POST',
            dataType: 'json',
            data: {
              uid: uid,
            }
          }).done(function (response) {
            console.log(response);
            $('#answersModal').modal('show');
          })
        })
        if ($('.js-udata').val() != 0) {
          $.ajax({
            url: 'https://edupen.vn/kiem-tra-bai-lam-chua-hoan-thanh',
            type: 'POST',
            dataType: 'json',
            data: {
              uid: $('.js-udata').val(),
            }
          }).done(function (response) {
            console.log(response);
            if (response.data.notify == 0) {
              let answer = JSON.parse(response.data.answer);
              $('#answersModal .modal-title').text('Bạn chưa hoàn thành bài thi lần cuối');
              $('.js-submit-continue').attr('href', response.data.path);
              $('.js-submit-giveup').attr('data-nid', response.data.eid)
              $('.js-data-answer').val(response.data.answer);
              $('.js-data-answer').after(`<input type="hidden" value="${response.data.eid}" class="js-data-eid">`)
              $('#confirmModal').modal('show');
            }
          })
        }
        $(document).on('click', '.js-submit-continue', function (e) {
          e.preventDefault();
          const path = $(this).attr('href');
          const eid = $('.js-data-eid').val();
          const uid = $('.js-udata').val();
          $.ajax({
            url: 'https://edupen.vn/cap-nhat-trang-thai-thi',
            type: 'POST',
            dataType: 'json',
            data: {
              uid: uid,
            }
          }).done(function (response) {
            console.log(response);
            window.location.href = `${path}`;
            $.session.set('answer', response.data.exam.answer);
            $.session.set('eid', response.data.exam.eid);
            $.session.set('leavetime', response.data.exam.leaveTime);
          })
        });

        if ($.session.get('answer')) {
          $('.js-data-answer').val($.session.get('answer'));
        }
        if ($.session.get('eid')) {
          $('.js-data-answer').after(`<input type="hidden" value="${$.session.get('eid')}" class="js-data-eid">`)
        }
        if ($.session.get('leavetime')) {
          $('.countdown').text($.session.get('leavetime'));
        }


        // let params = {
        //   searchable: true,
        //   startCollapsed: true,
        //   allowBatchSelection: false,
        //   showSectionOnSelected: false
        // };
        // $('#edit-field-danh-muc-und').treeMultiselect(
        //   params
        // )
        $(document).on('click', '.js-submit-add-to-cart-form', function (e) {
          e.preventDefault();
          $(this).parent().find('.js-add-to-cart-form form').submit();
        })

        $("#is-agree").change(function () {
          if (this.checked) {
            $('.js-submit-dk').removeClass('disabled');
          } else {
            $('.js-submit-dk').addClass('disabled');
          }
        });
        $(document).on('click', '.js-submit-dk', function (e) {
          e.preventDefault();
          const uid = $(this).data('value');
          const path = $(this).attr('href');
          $.ajax({
            url: 'https://edupen.vn/them-yeu-cau-nang-cap-tk',
            type: 'POST',
            dataType: 'json',
            data: {
              uid: uid,
            }
          }).done(function (response) {
            console.log(response);
            window.location.href = 'https://edupen.vn' + path;
          })
        })
        $('#checked-dk').change(function (e) {
          const uid = $(this).data('value');
          const nid = $(this).data('nid');
          if (this.value == 'đã duyệt') {
            $.ajax({
              url: 'https://edupen.vn/duyet-nang-cap-tai-khoan',
              type: 'POST',
              dataType: 'json',
              data: {
                uid: uid,
                status: 'Đã duyệt',
                nid: nid,
              },
              success: function (data) {
                $.alert({
                  title: '',
                  content: '<div class="notify text-center"><div class="content mb-4"><h4>Duyệt thành công</h4></div><span class="icon-check"><i class="fas fa-check-circle"></i></span></div>',
                  type: 'green',
                  typeAnimated: true,
                  buttons: {
                    close: {
                      text: 'Đóng lại',
                      btnClass: 'btn-green mt-3',
                      action: function (e) {
                        location.reload(true);
                      }
                    },
                  }
                });
              },
              error: function (e) {
                console.log(e)
              }
            })
          }
        })
        $('#uncheck-dk').change(function (e) {
          const uid = $(this).data('value');
          const nid = $(this).data('nid');
          if (this.value == 'không duyệt') {
            $.ajax({
              url: 'https://edupen.vn/duyet-nang-cap-tai-khoan',
              type: 'POST',
              dataType: 'json',
              data: {
                uid: uid,
                status: 'Không duyệt',
                nid: nid,
              },
              success: function (data) {
                $.alert({
                  title: '',
                  content: '<div class="notify text-center"><div class="content mb-4"><h4>Duyệt thành công</h4></div><span class="icon-check"><i class="fas fa-check-circle"></i></span></div>',
                  type: 'green',
                  typeAnimated: true,
                  buttons: {
                    close: {
                      text: 'Đóng lại',
                      btnClass: 'btn-green mt-3',
                      action: function (e) {
                        location.reload(true);
                      }
                    },
                  }
                });
              },
              error: function (e) {
                console.log(e)
              }
            })
          }
        });
        if ($('.chosen-container-multi').length > 0){
          $('.chosen-container-multi').removeClass('form-select');
        }
        var pathname = window.location.pathname;
        let type = pathname.split('/',)[1];
        console.log(pathname.split('/',));
        if (type == 'de-thi'){
          $('body').addClass('no-scroll');
        }

        function updateTextView(_obj){
          var num = getNumber(_obj.val());
          if(num==0){
            _obj.val('');
          }else{
            _obj.val(num.toLocaleString());
          }
        }
        function getNumber(_str){
          var arr = _str.split('');
          var out = new Array();
          for(var cnt=0;cnt<arr.length;cnt++){
            if(isNaN(arr[cnt])==false){
              out.push(arr[cnt]);
            }
          }
          return Number(out.join(''));
        }
        $('.form-item-field-gia-de-thi-und-0-value').each(function (e){
          const inputPriceClone = $(this).clone();
          $(this).addClass('d-none');
          inputPriceClone.removeClass('form-item-field-gia-de-thi-und-0-value');
          inputPriceClone.addClass('form-item-field-gia-de-thi-und-0-value-clone');
          inputPriceClone.find('input').removeAttr('id');
          inputPriceClone.find('input').removeAttr('name');
          $(this).after(inputPriceClone);
          if ($(this).find('input').val() !== ''){
            formated_price = inputPriceClone.find('input').val() * 1;
            formated_price = formated_price.toLocaleString('en-US');
            inputPriceClone.find('input').val(formated_price);
          }

        });
        $('.form-item-field-gia-de-thi-und-0-value-clone input').on('keyup',function(e){
          this.value = this.value.replace(/[^0-9]/g, '');
          updateTextView($(this));
          let vRealinput = $(this).val().replaceAll(',','');
          $(this).parent().prev().find('input').val(vRealinput);
        })

      })
    }
  };
})(jQuery);



