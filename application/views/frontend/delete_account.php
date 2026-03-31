<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Delete Account - Karakover</title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/fav-icon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f6f6f6;
    }

    .card {
      border-radius: 30px;
    }

    .da-wrap {
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    .card-body {
      background-color: #fff;
      box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.09);
      border-radius: 30px;
      border: 1px solid #e6e6e6;
    }

    .form-label {
      font-weight: 600;
    }

    button.btn.btn-danger {
      border-radius: 100px;
      margin-inline: auto;
      display: block;
      margin-top: 24px;
    }

    .password-wrap {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      border: none;
      background: transparent;
      padding: 4px;
      cursor: pointer;
      color: #6c757d;
    }
  </style>
</head>

<body>
  <section class="da-wrap">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card shadow-sm border-0">
            <div class="card-body p-4">
              <div class="text-center mb-4">
                <div style="display: inline-block; padding: 12px 18px; background: #1f1f1f; border-radius: 12px;">
                  <img src="https://159.223.251.167/assets/logo.png" alt="Karakover Logo" style="max-width: 180px; height: auto;">
                </div>
              </div>
              <h3 class="mb-0 text-center">Delete Account</h3>
              <p class="text-muted mb-4 text-center">
                Enter your email and password to request account deletion. After this, you will no longer be able to log in.
              </p>

              <?php if ($this->session->flashdata('delete_error')) { ?>
                <div class="alert alert-danger">
                  <?php echo $this->session->flashdata('delete_error'); ?>
                </div>
              <?php } ?>

              <?php if ($this->session->flashdata('delete_success')) { ?>
                <div class="alert alert-success">
                  <?php echo $this->session->flashdata('delete_success'); ?>
                </div>
              <?php } ?>

              <form action="<?php echo base_url('delete-account'); ?>" method="post" autocomplete="off">
                <div class="mb-3">
                  <label for="delete_email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="delete_email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                  <label for="delete_password" class="form-label">Password</label>
                  <div class="password-wrap">
                    <input type="password" class="form-control" id="delete_password" name="password" placeholder="Enter your password" required>
                    <button type="button" class="password-toggle" aria-label="Show password" id="toggle_password">
                      <svg class="eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M2 12C4.5 7 8 4.5 12 4.5C16 4.5 19.5 7 22 12C19.5 17 16 19.5 12 19.5C8 19.5 4.5 17 2 12Z" stroke="currentColor" stroke-width="1.6" />
                        <circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.6" />
                      </svg>
                      <svg class="eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true" style="display: none;">
                        <path d="M3 4.5L21 19.5" stroke="currentColor" stroke-width="1.6" />
                        <path d="M4.5 9C6.5 6.5 9 5 12 5C16 5 19.5 7.5 22 12C21.2 13.6 20.2 14.9 19.1 15.9" stroke="currentColor" stroke-width="1.6" />
                        <path d="M9.5 7.5C10.3 7.2 11.1 7 12 7C14.8 7 17 9.2 17 12C17 12.9 16.8 13.7 16.5 14.5" stroke="currentColor" stroke-width="1.6" />
                        <path d="M6.7 11C6.6 11.3 6.5 11.6 6.5 12C6.5 14.8 8.7 17 11.5 17C11.9 17 12.2 16.9 12.5 16.8" stroke="currentColor" stroke-width="1.6" />
                        <path d="M2 12C2.9 13.8 4.1 15.2 5.5 16.3" stroke="currentColor" stroke-width="1.6" />
                      </svg>
                    </button>
                  </div>
                </div>
                <button type="submit" class="btn btn-danger w-100">Delete Account</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    (function() {
      var toggle = document.getElementById('toggle_password');
      var input = document.getElementById('delete_password');
      if (toggle && input) {
        toggle.addEventListener('click', function() {
          var isPassword = input.getAttribute('type') === 'password';
          input.setAttribute('type', isPassword ? 'text' : 'password');
          toggle.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
          var eyeOpen = toggle.querySelector('.eye-open');
          var eyeClosed = toggle.querySelector('.eye-closed');
          if (eyeOpen && eyeClosed) {
            eyeOpen.style.display = isPassword ? 'none' : 'inline';
            eyeClosed.style.display = isPassword ? 'inline' : 'none';
          }
        });
      }
    })();
  </script>
</body>

</html>
