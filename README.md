# Yeich
Yeich is software management software app. This repo is rest api for user based part of application

This part of project  provides users with services such as accessing restaurant information, instant access to discounts, online booking, online payment.

## Installing Yeich
Through below command, you can install this project to your computer.

`git clone https://github.com/azerabishov/yeich.git`

##Using Yeich

Through Postman, you can test feature of yeich.
#####Auth commands
* Register: post request to `http://<host name>/api/register` with appropriate data.
* Login: post request to `http://<host name>/api/login` with email and password.
* Verify email: post request to `http://<host name>/api/email/verify` with email.
* Resend verification email: post request to `http://<host name>/api/email/resend` with
email.
* Email verification: post request to `http://<host name>/api/email/verify` with verification_code.
* Send password reset email: post request to `http://<host name>/api/password/email` with email.
* Reset password: post request to `http://<host name>/api/password/reset` with password and password_confirmation.
* Update email: post request to `http://<host name>/api/user/{id}/email`
* Update password: post request to `http://<host name>/api/user/{id}/password`

#####Restaurant commands

* Get restaurant information: get request to `http://<host name>/api/restaurant/{id}`
* Get all offers: get request to `http://<host name>/api/offers`
* Filter and search restaurant: post request to`http://<host name>/api/restaurant/filter`
* Get restaurant rating: post request to`http://<host name>/api/rating/{id}`

#####Collection commands
* Add collection: post request to `http://<host name>/add_collection`
* Get collection: post request to `http://<host name>/collections`
* Save restaurant to collection: post request to `http://<host name>/save/{id}`
* Remove restaurant from collection: post request to `http://<host name>/save/{id}/remove`





