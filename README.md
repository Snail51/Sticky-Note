# Sticky Note

## Purpose
 - This program provides a simple webapp to write down small amounts of information for later reconciliation.
 - This app was made to facilitate my interest in writing down how, when, and why I spend my time throughout my life, such that I can analyze that data to identify trends and improve my productivity.
 - This app is not intended for use by anyone but me, but could be duplicated into a separate environment if someone else wanted to use it.
 - This tool was originally created by Brendan Rood on or about 2025-03-04.

## Installation / Usage
 - Can be run in any httpx environment with JavaScript execution and PHP.
 - This codebase assumes the server is running though a cloudflared reverse proxy. If this is not the case, the `HTTP_CF_CONNECTING_IP` in `writer.php` will need adjustment.
 - My copy of this application is located at https://tools.snailien.net/Sticky/. ***ANYTHING YOU PUT HERE WILL BE DELETED!***

## Security Concerns
 For this tool to be useful, it must be accessible on the global web. Thus, anyone could write data to it, which poses a security risk. The following steps have been taken to alleviate this issue:
 - Prevent any single request from writing more than 8KB of data to the server.
 - Write down the IP address of the client making the request. If the IP is not one I recognize as myself, those entries can be easily deleted.
 - This program writes its values to `record.json` with linux write-only permissions (`-rwx-w----`), and the PHP operation to write the content is of directive `FILE_APPEND`. These options make reading what has been written impossible. Reading MUST be done manually by the admin.

## (Potential) Future Plans
 - Limit requests from the same IP address to wait at least 60 seconds between subsequent entries
 - Move service to separate container (with separate subdomain)
 - Create web-based record reader (locked behind cloudflare access!)