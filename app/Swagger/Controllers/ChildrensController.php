<?php

namespace App\Swagger\Controllers;

class ChildrensController
{

    /**
 * @OA\Get(
 *      path="/api//parented.children",
 *      operationId="getChildrenListForParent",
 *      tags={"CHILDRENS"},
 *      summary="Get list of childrens",
 *      description="Returns list of childrens",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *       ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 *     )
 */

    public function index()
    {

    }

    public function store()
    {

    }

    public function show(string $id)
    {

    }

    public function update()
    {

    }

    public function destroy(string $id)
    {

    }
}
