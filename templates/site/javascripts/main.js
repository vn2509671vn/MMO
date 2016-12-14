$(document).ready(function() {
    window.setTimeout(function() {
        $(".alert").fadeTo(1500, 0.4).slideUp(1500, function() {
            $(this).remove();
        })
    }, 3000), $("#menu-toggle").click(function(a) {
        a.preventDefault(), $("#wrapper").toggleClass("toggled");
    })
});

function xacnhan(username) 
{
    if (!window.confirm('Are you sure you want to approve account "'+username+'" ?')) {
        return false;
    }
    return true;
}

function xacnhanlock(username) 
{
    if (!window.confirm('Are you sure you want to lock account "'+username+'" ?')) {
        return false;
    }
    return true;
}

function xacnhanunlock(username) 
{
    if (!window.confirm('Are you sure you want to unlock account "'+username+'" ?')) {
        return false;
    }
    return true;
}
/* new */
function xacnhan_ruttien() 
{
  sotien = document.getElementById('sotien').value;
  var sotienrut = sotien*(90/100);
    if (!window.confirm('The amount of money you will recieve is "'+sotienrut+'". Do you want to continue?')) {
        return false;
    }
    return true;
}

function remove(username) 
{
    if (!window.confirm('Are you sure you want to delete account "'+username+'" ?')) {
        return false;
    }
    return true;
}

function ruttien(link, id, link2) 
{
  $(function() {
  $("#dialog-confirm").dialog({
      autoOpen: true,
      modal: true,
      width: 320,
      buttons: {
          "Done": function() {
              var transaction_hash = document.getElementById("transaction_hash").value;
              if(transaction_hash == '')
                return alert('Error input!');
              $.ajax({
                url: link,
                type: 'post',
                data: 'id=' +id+ '&transaction_hash=' +transaction_hash,
                beforeSend: function() {
                   $("#ajaxLoad").css("display", "block");
                },
                complete: function() {
                   $("#ajaxLoad").css("display", "none");
                },
                success: function(data) {
                  if(data != 'f')
                  {
                    window.location.href = data;
                  }
                  else
                  {
                    alert('Not enough money to withdraw');
                    window.location.href = link2;
                    return false;
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
              });
              $(this).dialog("close");
          }
          },
          "Hủy bỏ": function() {
              $(this).dialog("close");
          }
      });
  });
}

$(function() {
    //  var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
    var pgurl = window.location.href.substr(window.location.href);
     $(".sidebar-nav a").each(function(){
          if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
          $(this).addClass("active");
     })
});