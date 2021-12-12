<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(title="My First API", version="0.1")
     */

    /**
     * @OA\SecurityScheme(
     *   securityScheme="bearerAuth",
     *   type="http",
     *   scheme="bearer"
     * )
     */

    /**
     * @OA\Post(path="/api/register",
     *   tags={"user"},
     *   summary="Create an user",
     *   description="",
     *   operationId="createUser",
     *   @OA\RequestBody(
     *       required=true,
     *       description="form to create user",
     *       @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="persistent", type="boolean", example="true"),
     *    ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\Schema()
     *   ),
     *   @OA\Response(response=400, description="Invalid input")
     * )
     */



    /**
     * @OA\Post(path="/api/login",
     *   tags={"user"},
     *   summary="Login with user information",
     *   description="",
     *   operationId="loginUser",
     *   @OA\RequestBody(
     *       required=true,
     *       description="form to login user",
     *       @OA\JsonContent()
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\Schema()
     *   ),
     *   @OA\Response(response=400, description="Invalid input")
     * )
     */

    /**
     * @OA\Get(path="/api/tasks",
     *   security={{"bearerAuth":{}}},
     *   tags={"tasks"},
     *   summary="Returns all tasks of user",
     *   description="",
     *   operationId="getTasks",
     *   parameters={},
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\Schema(
     *       additionalProperties={
     *         "type":"integer",
     *         "format":"int32"
     *       }
     *     )
     *   )
     * )
     */

    /**
     * @OA\Get(path="/api/tasks/{taskId}",
     *   security={{"bearerAuth":{}}},
     *   tags={"tasks"},
     *   summary="Find tasks by ID",
     *   description="",
     *   operationId="getTasksId",
     *   @OA\Parameter(
     *     name="taskId",
     *     in="path",
     *     description="ID of task that needs to be fetched",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         minimum=1.0,
     *         maximum=10.0
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\Schema()
     *   ),
     *   @OA\Response(response=400, description="Invalid ID supplied"),
     *   @OA\Response(response=404, description="Task not found")
     * )
     */

    /**
     * @OA\Put(path="/api/tasks/{taskId}",
     *   security={{"bearerAuth":{}}},
     *   tags={"tasks"},
     *   summary="Updated task",
     *   description="",
     *   operationId="updateTask",
     *   @OA\Parameter(
     *     name="taskId",
     *     in="path",
     *     description="",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response=400, description="Invalid user supplied"),
     *   @OA\Response(response=404, description="User not found"),
     *   @OA\RequestBody(
     *       required=true,
     *       description="Updated tasks object",
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema()
     *       )
     *   ),
     * )
     */

    /**
     * @OA\Delete(path="/api/tasks/{taskId}",
     *   security={{"bearerAuth":{}}},
     *   tags={"tasks"},
     *   summary="Delete task order by ID",
     *   description="",
     *   operationId="deleteTask",
     *   @OA\Parameter(
     *     name="taskId",
     *     in="path",
     *     required=true,
     *     description="",
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         minimum=1.0
     *     )
     *   ),
     *   @OA\Response(response=400, description="Invalid ID supplied"),
     *   @OA\Response(response=404, description="Order not found")
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
