(**
 * Copyright (c) 2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the "hack" directory of this source tree.
 *
 *)


(*****************************************************************************)
(* Error module                                                              *)
(*****************************************************************************)
open Core_kernel
open Utils

let get_errorl_json el =
  if el = [] then
    Hh_json.JSON_Object [ "passed", Hh_json.JSON_Bool true;
                  "errors", Hh_json.JSON_Array [];
                  "version", Hh_json.JSON_String Build_id.build_id_ohai;
                ]
  else
    let errors_json = List.map ~f:Errors.to_json el in
    Hh_json.JSON_Object [ "passed", Hh_json.JSON_Bool false;
                  "errors", Hh_json.JSON_Array errors_json;
                  "version", Hh_json.JSON_String Build_id.build_id_ohai;
                ]

let print_errorl_json oc el =
  let res = get_errorl_json el in
  Hh_json.json_to_output oc res;
  Out_channel.flush oc

let print_errorl is_stale_msg use_json el oc =
  if use_json then
    print_errorl_json oc el
  else begin
    if el = []
    then Out_channel.output_string oc "No errors!\n"
    else
      let sl = List.map ~f:Errors.to_string el in
      let sl = List.dedup_and_sort ~compare:String.compare sl in
      List.iter ~f:begin fun s ->
        if !debug then begin
          Out_channel.output_string stdout s;
          Out_channel.flush stdout;
        end;
        Out_channel.output_string oc s;
        Out_channel.output_string oc "\n";
      end sl
  end;
  Option.iter is_stale_msg ~f:(fun msg -> Out_channel.output_string oc msg);
  Out_channel.flush oc
