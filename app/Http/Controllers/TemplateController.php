<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\User;

class TemplateController extends Controller
{
    public function index()
    {
        return response()->json(Template::all());
    }

    public function show($id)
    {
        $template = Template::find($id);
        if (!$template) {
            return response()->json(['message' => 'Template not found'], 404);
        }
        return response()->json($template);
    }

    public function getUserTemplate(Request $request)
    {
        $user = $request->user();
        $template = $user->template;
        if (!$template) {
            return response()->json(['message' => 'No template selected'], 404);
        }

        return response()->json($template);
    }
}
