# Run me with:
#
# $ watchr test/test_spec.watchr

def run_all_tests
  system  "phpunit test/*"
end

# Watchr Rules
watch('test/(.*)\.php') { |m| system "phpunit #{m[0]}" }
watch('lib/(.*)\.php')  { |m| system "phpunit test/#{m[1]}Test.php" }

# --------------------------------------------------
# Signal Handling
# --------------------------------------------------
# Ctrl-\
Signal.trap('QUIT') do
  puts " --- Running all tests ---\n\n"
  run_all_tests
end
 
# Ctrl-C
Signal.trap('INT') { abort("\n") }
