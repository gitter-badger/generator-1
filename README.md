Cotya/Generator
===============

*generates you whole modules(magento,more) from more or less then an xml file*
    


**To describe it, let me steal this Question:**  
  
    how does this compare to n98 magerun code generation and/or the ultimate module creator extension?

It compares not very well because of the very early stage it is in.  
It differs from them, as it uses an xml document as base instead of a cli or web UI.
Also this document is defined framework agnostic. 
The adcentage will be, that you can generate a magento 1 or 2 module from the same base, and in theory even a symfony one.  
Another adventage of a standardized format will be the possibility of easy buildable custom UIs for define new modules,
as they only need to work with a simplified xml document.

But thats only theory yet, help and put this into practice.



##How Can I help?

We need to define a Schema/Standard for the base xml, and we also need Ideas for features
(different things which could or should be able to generate from simple xml)


##How can I test it

1. Check out the Repository via git
2. `composer.phar install`
3. try out the stuff in the examples directory


