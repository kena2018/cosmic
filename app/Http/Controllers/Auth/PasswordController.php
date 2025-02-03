<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\User;
use DB;
use Auth;
use Str;
use App\Helpers\email_sender;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function forgotpass(Request $request)
    {
        return view('auth.forgot-password');
    }

    // public function sendEmail(Request $request)
    // {        
    //     $formData = $request->all();
    //     $user = User::where('email', $formData['email'])->first();
    
    //     if (empty($user)) {
    //         return response()->json(['status' => 'error', 'message' => 'Please check your email']);    
    //     }
        
    //     $details = [
    //         'title' => 'Mail from Reflowx',
    //         'body' => 'This is only a test mail'
    //     ];
        
    //     $token = Str::random(64);
    //     $user->remember_token = $token;
    //     $user->save();
        
    //     // Prepare email data
    //     $emailData = [
    //         'email' => $formData['email'],
    //         'token' => $token,
    //         'name' => $user->name
    //     ];
        
    //     // Send the email using Laravel's Mail facade
    //     Mail::send('auth.reset-password', ['token' => $token, 'name' => $user->name], function ($message) use ($formData) {
    //         $message->to($formData['email'])
    //                 ->subject('Password Reset Link');
    //     });

    //     return response()->json(['status' => 'success', 'message' => 'A password reset link has been sent to your email']);
    // }

    public function sendEmail(Request $request)
{
    $formData = $request->all();
    $user = User::where('email', $formData['email'])->first();

    if (empty($user)) {
        return response()->json(['status' => 'error', 'message' => 'Please check your email']);    
    }
    
    $token = Str::random(64);
    $user->remember_token = $token;
    $user->save();
    
    // Generate the password reset URL
    $resetUrl = url('/resetpass/' . $token);

    // Send the email using Laravel's Mail facade
    // Email_sender::sendEmail('emails.view_name', $settings);

    Mail::send('email-templates.reset-password-email', ['resetUrl' => $resetUrl], function ($message) use ($formData) {
        $message->to($formData['email'])
                ->subject('Password Reset Link');
    });

    return response()->json(['status' => 'success', 'message' => 'A password reset link has been sent to your email']);
}


    

    public function resetPass(Request $request, $token)
    {
        $user = User::where('remember_token', $token)->first();
    
        // If no user is found with the token, redirect back with an error
        if (!$user) {
            return redirect()->route('password.request')->withErrors(['token' => 'Invalid or expired token.']);
        }
    
        // Pass the user and token to the view
        return view('auth.reset-password', compact('user', 'token'));
    }

    // public function passchange(Request $request,$token)
    // {
    //     $formData = $request->all();
    //    $user = User::where('remember_token',$token)->first();
       
    //    $user->password = Hash::make($formData['password']);
    //    $user->save();
    //    return redirect('admin/login')->with('success', 'Password Update successfully');
    // }

    public function passchange(Request $request, $token)
    {
        // Validate the new password
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
    
        // Find the user by token
        $user = User::where('remember_token', $token)->first();
        
        if (!$user) {
            return redirect()->route('password.request')->withErrors(['token' => 'Invalid or expired token.']);
        }
    
        // Update the password
        $user->password = Hash::make($request->password);
        $user->remember_token = null; // Clear the token after the password is changed
        $user->save();
    
        // Redirect to login page with a success message
        return redirect('admin/login')->with('success', 'Your password has been changed successfully.');
    }
    

}
